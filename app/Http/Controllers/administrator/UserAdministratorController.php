<?php


namespace App\Http\Controllers\administrator;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Employee;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserAdministratorController extends Controller
{
    public function __construct()
    {
        $this->admin = new Administrator();
        $this->user = new User();
        $this->employee = new Employee();
    }

    public function index()
    {
        $data = [
            'admin' => $this->admin->getData(),
        ];

        return view('administrator.admin.index', $data);
    }

    public function show($id)
    {
        $administrator = Administrator::findOrFail($id);

        $data = [
            'admin' => $administrator,
        ];

        return view('administrator.admin.detail', $data);
    }

    public function add()
    {
        $data = [
            'roles' => Role::find(3),  //* administrator
        ];

        return view('administrator.admin.add', $data);
    }

    public function validateAdmin(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'id_role' => 'required|integer',
            'password' => 'required|max:255',
        ], [
            'nama.required' => 'wajib diisi!',
            'jabatan.required' => 'wajib diisi!',
            'email.email' => 'Isi format Email dengan benar.',
            'email.unique' => 'Email ini telah digunakan.',
            'email.required' => 'Mohon isi Email.',
            'password.required' => 'Mohon isi Password.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|max:255',
        ]);
        $this->validateAdmin($request);

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

        $userAdmin = Administrator::create([
            'id_employee' => $employee->id,
            'created_by' => Employee::find(Auth::user()->id)->administrator->id,
        ]);

        if ($user && $employee && $userAdmin) {
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }
        return redirect('/admin/user/admin');
    }


    public function edit($id)
    {
        $administrator = Administrator::findOrFail($id);

        $data = [
            'admin' => $administrator,
            'roles' => Role::find(3),
        ];

        return view('administrator.admin.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $this->validateAdmin($request);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $id_user = Administrator::find($id)->employee->id_user;
            $user = User::where('id', $id_user)->update($data);
        } catch (\Throwable $th) {
            Alert::error('Gagal!', 'Email sudah digunakan!');
            return redirect()->back();
        }

        $employee = Employee::where('id', $request->id_employee)
            ->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ]);

        $administrator = Administrator::where('id', $id)
            ->update([
                'updated_by' => Employee::find(Auth::user()->id)->administrator->id,
            ]);

        if ($user && $employee && $administrator) {
            Alert::success('Sukses!', 'Data berhasil diubah!');
        }

        return redirect('/admin/user/admin');
    }

    public function destroy($id)
    {
        $id_user = Administrator::findOrFail($id)->employee->id_user;

        $userAdmin = User::find($id_user)->employee->administrator->delete();
        $employee = User::find($id_user)->employee->delete();
        $user = User::find($id_user)->delete();

        if ($user && $employee && $userAdmin) {
            Alert::success('Sukses!', 'Data berhasil dihapus!');
        }

        return redirect('/admin/user/admin');
    }
}