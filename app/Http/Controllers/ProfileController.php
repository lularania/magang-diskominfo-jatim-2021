<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        return view('profile');
    }

    public function updatePass($id)
    {
        Request()->validate([
            'password' => 'required|max:255',
        ], [
            'password.required' => 'Mohon isi Password.',
        ]);

        $data = [
            'password' => Hash::make(Request()->password),
        ];
         if ($this->user->updateData($id, $data)) {
            Alert::success('Sukses!', 'Password berhasil diubah!');
        };
        return redirect()->back();
    }
}