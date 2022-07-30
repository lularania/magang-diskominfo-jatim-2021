<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserPimpinanController extends Controller
{
    public function __construct()
    {
        $this->pimpinan = new UserPimpinan();
        $this->user = new User();
    }

    public function index()
    {
        $data = [
            'pimpinan' => $this->pimpinan->getData(),
        ];
        return view('administrator.user_pimpinan.index', $data);
    }

    public function show($id)
    {
        $pimpinan = UserPimpinan::findOrFail($id);

        $data = [
            'pimpinan' => $pimpinan,
        ];

        return view('administrator.user_pimpinan.detail', $data);
    }

    public function add()
    {
        $data = [
            'roles' => Role::find(1),           //* pimpinan
        ];

        return view('administrator.user_pimpinan.add', $data);
    }

    public function validatePimpinan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'password' => 'required|max:255',
            'id_role' => 'required|integer',
        ], [
            'nama.required' => 'wajib diisi!',
            'jabatan.required' => 'wajib diisi!',
            'email.email' => 'Isi format Email dengan benar.',
            'email.required' => 'Mohon isi Email.',
            'email.unique' => 'Email ini telah digunakan.',
            'password.required' => 'Mohon isi Password.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|max:255',
        ]);
        $this->validatePimpinan($request);

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

        $userPimpinan = UserPimpinan::create([
            'id_employee' => $employee->id,
            'created_by' => Employee::find(Auth::user()->id)->administrator->id,
        ]);

        if ($userPimpinan && $employee && $user) {
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }

        return redirect('/admin/user/pimpinan');
    }

    public function edit($id)
    {
        $pimpinan = UserPimpinan::findOrFail($id);

        $data = [
            'pimpinan' => $pimpinan,
            'roles' => Role::find(1),
        ];

        return view('administrator.user_pimpinan.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $this->validatePimpinan($request);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $id_user = UserPimpinan::find($id)->employee->id_user;
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

        $userPimpinan = UserPimpinan::where('id', $id)
            ->update([
                'updated_by' => Employee::find(Auth::user()->id)->administrator->id,
            ]);

        if ($employee && $user && $userPimpinan) {
            Alert::success('Sukses!', 'Data berhasil diupdate!');
        }

        return redirect('/admin/user/pimpinan');
    }

    public function destroy($id)
    {
        $id_user = UserPimpinan::findOrFail($id)->employee->id_user;

        $userpimpinan = User::find($id_user)->employee->pimpinan->delete();
        $employee = User::find($id_user)->employee->delete();
        $user = User::find($id_user)->delete();

        if ($userpimpinan && $employee && $user) {
            Alert::success('Sukses!', 'Data berhasil dihapus!');
        }

        return redirect('/admin/user/pimpinan');
    }
}