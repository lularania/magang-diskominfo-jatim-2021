<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPimpinan;
use App\Models\UserTeknisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->employee = new Employee();
        $this->role = new Employee();
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $employee = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $employee = Employee::all();
        }
        // dd($employee);
        $data = [
            'role1' => $this->role->countRole(1),
            'role2' => $this->role->countRole(2),
            'role3' => $this->role->countRole(3),
            'role4' => $this->role->countRole(4),
            'employee' => $employee,                        // ! TODO : Apakah data Admin perlu ditampilkan
        ];
        return view('administrator.employee.index', $data);
    }

    public function show($id)
    {
        if (!$this->employee->detailData($id)) {
            abort(404);
        }

        $data = [
            'employee' => Employee::find($id),
        ];

        return view('administrator.employee.detail', $data);
    }

    public function add()
    {
        $data = [
            'opsi_role' => DB::table('roles')
                ->whereNotIn('id', [4])
                ->get(),
        ];
        return view('administrator.employee.add', $data);
    }

    public function insert(Request $request)
    {
        Request()->validate(
            [
                'nama' => 'required',
                'jabatan' => 'required',
                'id_role' => 'required',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required',
            ],
            [
                'nama.required' => 'wajib diisi!',
                'jabatan.required' => 'wajib diisi!',
                'email.required' => 'wajib diisi!',
                'password.required' => 'wajib diisi!',
            ]
        );

        $user = User::create([
            'id_role' => $request->id_role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole(Role::find($request->id_role)->name);

        $employee = Employee::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        if ($employee && $user) {
            switch ($request->id_role) {
                case 1:
                    $pimpinan = UserPimpinan::create([
                        'id_employee' => $employee->id,
                        'created_by' => User::find(Auth::user()->id)->employee->administrator->id,
                    ]);
                    if ($pimpinan) {
                        break;
                    }

                case 2:
                    $teknisi = UserTeknisi::create([
                        'id_employee' => $employee->id,
                        'created_by' => User::find(Auth::user()->id)->employee->administrator->id,
                    ]);
                    if ($teknisi) {
                        break;
                    }

                default:
                    $administrator = Administrator::create([
                        'id_employee' => $employee->id,
                        'created_by' => User::find(Auth::user()->id)->employee->administrator->id,
                    ]);
                    if ($administrator) {
                        break;
                    }
            }
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }

        return redirect('/admin/employee');
    }

    public function edit($id)
    {
        if (!$this->employee->detailData($id)) {
            abort(404);
        }

        $data = [
            'employee' => Employee::find($id),
            'opsi_role' => DB::table('roles')->whereNotIn('id', [Employee::find($id)->user->role->id, 4])->get(),
        ];

        return view('administrator.employee.edit', $data);
    }

    public function update($id)
    {
        Request()->validate(
            [
                'nama' => 'required',
                'jabatan' => 'required',
                'id_role' => 'required'
            ],
            [
                'nama.required' => 'wajib diisi!',
                'jabatan.required' => 'wajib diisi!'
            ]
        );

        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user->id);

        $data = [
            'nama' => Request()->nama,
            'jabatan' => Request()->jabatan,
        ];

        $employee->user->id_role = Request()->id_role;
        if ($employee->user->save()) {
            $user->syncRoles([Role::find(Request()->id_role)->name]);
            $updateEmployee = Employee::where('id', $id)->update($data);
            if ($updateEmployee) {
                Alert::success('Sukses!', 'Data berhasil diupdate!');
            }
        }

        return redirect('/admin/employee');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            abort(404);
        }

        switch ($employee->user->id_role) {
            case 1:
                // UserPimpinan::where('id_employee', $id)->delete();
                if (DB::table('user_pimpinans')->where('id_employee', $id)->delete()) {
                    break;
                }

            case 2:
                // UserTeknisi::where('id_employee', $id)->delete();
                if (DB::table('user_teknisis')->where('id_employee', $id)->delete()) {
                    break;
                }
        }

        if (DB::statement('SET FOREIGN_KEY_CHECKS=0;')) {                            //! TODO
            $id_user = $employee->id_user;
            $employee =  Employee::find($id)->delete();
            $user = User::find($id_user)->delete();

            if ($employee && $user) {
                Alert::success('Sukses!', 'Data berhasil dihapus!');
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect('/admin/employee');
    }
}