<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use App\Models\UserTeknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserTeknisiController extends Controller
{
    public function __construct()
    {
        $this->teknisi = new UserTeknisi();
        $this->user = new User();
    }

    public function index()
    {
        $data = [
            'teknisi' => $this->teknisi->getData(),
        ];

        return view('administrator.user_teknisi.index', $data);
    }

    public function show($id)
    {
        $teknisi = UserTeknisi::findOrFail($id);

        $data = [
            'teknisi' => $teknisi,
        ];

        return view('administrator.user_teknisi.detail', $data);
    }

    public function add()
    {
        $data = [
            'roles' => Role::find(2),  //* teknisi
        ];

        return view('administrator.user_teknisi.add', $data);
    }

    public function validateTeknisi(Request $request)
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
        $this->validateTeknisi($request);

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

        $userTeknisi = UserTeknisi::create([
            'id_employee' => $employee->id,
            'created_by' => Employee::find(Auth::user()->id)->administrator->id,
        ]);

        if ($user && $employee && $userTeknisi) {
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }

        return redirect('/admin/user/teknisi');
    }

    public function edit($id)
    {
        $teknisi = UserTeknisi::findOrFail($id);

        $data = [
            'teknisi' => $teknisi,
            'roles' => Role::find(2),
        ];

        return view('administrator.user_teknisi.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $this->validateTeknisi($request);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $id_user = UserTeknisi::find($id)->employee->id_user;
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

        $userTeknisi = UserTeknisi::where('id', $id)
            ->update([
                'updated_by' => Employee::find(Auth::user()->id)->administrator->id,
            ]);

        if ($user && $employee && $userTeknisi) {
            Alert::success('Sukses!', 'Data berhasil diubah!');
        }

        return redirect('/admin/user/teknisi');
    }

    public function destroy($id)
    {
        $id_user = UserTeknisi::findOrFail($id)->employee->id_user;

        $userTeknisi = User::find($id_user)->employee->teknisi->delete();
        $employee = User::find($id_user)->employee->delete();
        $user = User::find($id_user)->delete();

        if ($user && $employee && $userTeknisi) {
            Alert::success('Sukses!', 'Data berhasil dihapus!');
        }

        return redirect('/admin/user/teknisi');
    }
}