<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\AdminOpd;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminOpdController extends Controller
{
    public function __construct()
    {
        $this->adminOpd = new AdminOpd();
    }


    public function index()
    {
        $data = [
            'adminOpd' => $this->adminOpd->getData(),
        ];

        return view('administrator.admin_opd.index', $data);
    }

    public function show($id)
    {
        $adminOpd = AdminOpd::findOrFail($id);

        $data = [
            'adminOpd' => $adminOpd,
        ];

        return view('administrator.admin_opd.detail', $data);
    }

    public function add()
    {
        $data = [
            'roles' => Role::find(4),           //* Admin OPD
            'instansi' => DB::table('instansis')->get(),
        ];

        return view('administrator.admin_opd.add', $data);
    }

    public function validateAdminOpd(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'instansi' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'email.email' => 'Isi format Email dengan benar.',
            'email.required' => 'Mohon isi Email.',
            'email.unique' => 'Email ini telah digunakan.',
            'nama.required' => 'Mohon isi Nama Admin OPD.',
            'instansi.required' => 'Mohon isi Asal Instansi Admin OPD.',
            'email.required' => 'Mohon isi Email.',
            'password.required' => 'Mohon isi Password.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|max:255',
        ]);
        $this->validateAdminOpd($request);

        $user = User::create([
            'id_role' => $request->id_role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole(Role::find($request->id_role)->name);

        $adminopd = AdminOpd::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'created_by' => Employee::find(Auth::user()->id)->administrator->id,
        ]);

        if ($adminopd && $user) {
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }

        return redirect('/admin/user/adminopd');
    }

    public function edit($id)
    {
        $adminOpd = AdminOpd::findOrFail($id);

        $data = [
            'adminOpd' => $adminOpd,
            'roles' => Role::find(4),               //* Admin OPD
        ];

        return view('administrator.admin_opd.edit', $data);
    }

    public function update($id, Request $request)
    {
        $adminOpd = AdminOpd::findOrFail($id);

        $request->validate([
            'email' => 'required|email|max:255',
            'id_user' => 'required|integer'
        ]);
        $this->validateAdminOpd($request);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $id_user = $adminOpd->id_user;
            $user = User::where('id', $id_user)
                ->update($data);
        } catch (\Throwable $th) {
            Alert::error('Gagal!', 'Email sudah digunakan!');
            return redirect()->back();
        }

        $adminopd = AdminOpd::where('id', $id)
            ->update([
                'nama' => $request->nama,
                'instansi' => $request->instansi,
                'updated_by' => Employee::find(Auth::user()->id)->administrator->id,
            ]);

        if ($adminopd && $user) {
            Alert::success('Sukses!', 'Data berhasil diupdate!');
        }

        return redirect('/admin/user/adminopd');
    }

    public function destroy($id)
    {
        $id_user = AdminOpd::findOrFail($id)->id_user;

        $adminopd = AdminOpd::find($id)->delete();
        $user = User::find($id_user)->delete();

        if ($adminopd && $user) {
            Alert::success('Sukses!', 'Data berhasil dihapus!');
        }

        return redirect('/admin/user/adminopd');
    }
}