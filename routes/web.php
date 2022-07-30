<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\administrator\HomeController as AdministratorHomeController;
use App\Http\Controllers\administrator\AdminOpdController;
use App\Http\Controllers\administrator\UserPimpinanController;
use App\Http\Controllers\administrator\UserTeknisiController;
use App\Http\Controllers\administrator\UserAdministratorController;
use App\Http\Controllers\administrator\KategoriPermohonanController;
use App\Http\Controllers\administrator\EmployeeController;
use App\Http\Controllers\administrator\PermohonanController as AdministratorPermohonanController;

use App\Http\Controllers\admin_opd\HomeController as Admin_opdHomeController;
use App\Http\Controllers\admin_opd\PermohonanController as Admin_opdPermohonanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\user_pimpinan\HomeController as User_pimpinanHomeController;
use App\Http\Controllers\user_pimpinan\PermohonanController as User_pimpinanPermohonanController;

use App\Http\Controllers\user_teknisi\HomeController as User_teknisiHomeController;
use App\Http\Controllers\user_teknisi\PermohonanController as User_teknisiPermohonanController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/storagelink', function () {
    Artisan::call('storage:link');
    return redirect()->back();
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return redirect()->back();
});

Route::get('/', function () {
    return redirect()->route('login');
});

// * Halaman Profile
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/profile/update/{id}', [ProfileController::class, 'updatePass'])->middleware('auth')->name('profile.update');

// * Export Permohonan
Route::get('/permohonan/export', [PermohonanController::class, 'export'])->middleware('auth')->name('permohonan.export');

// * View Administrator 
Route::group([
    'prefix' => '/admin',
    'middleware' => [
        'auth',
        'role:admin',
    ]
], function () {
    Route::get('/', [AdministratorHomeController::class, 'index'])->name('admin');

    // Halaman Data Pegawai
    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee');
    Route::get('/employee/detail/{id}', [EmployeeController::class, 'show'])->name('admin.employee.detail');
    Route::get('/employee/add', [EmployeeController::class, 'add'])->name('admin.employee.add');
    Route::post('/employee/insert', [EmployeeController::class, 'insert'])->name('admin.employee.insert');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/employee/update/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
    Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');

    // Halaman Data Permohonan
    Route::get('/permohonan', [AdministratorPermohonanController::class, 'index'])->name('admin.permohonan');
    Route::get('/permohonan/add', [AdministratorPermohonanController::class, 'add'])->name('admin.permohonan.add');
    Route::post('/permohonan/insert', [AdministratorPermohonanController::class, 'insert'])->name('admin.permohonan.insert');
    Route::get('/permohonan/detail/{id}', [AdministratorPermohonanController::class, 'detail'])->name('admin.permohonan.detail');
    Route::get('/permohonan/edit/{id}', [AdministratorPermohonanController::class, 'edit'])->name('admin.permohonan.edit');
    Route::post('/permohonan/update/{id}', [AdministratorPermohonanController::class, 'update'])->name('admin.permohonan.update');
    Route::get('/permohonan/delete/{id}', [AdministratorPermohonanController::class, 'destroy'])->name('admin.permohonan.delete');
    Route::get('/permohonan/view/{id}', [AdministratorPermohonanController::class, 'viewFile'])->name('admin.permohonan.view');
    Route::get('/permohonan/file/{id}', [AdministratorPermohonanController::class, 'generateFile'])->name('admin.permohonan.file');
    Route::get('/permohonan/status', [AdministratorPermohonanController::class, 'updateStatus'])->name('admin.permohonan.status');
    Route::get('/permohonan/reject', [AdministratorPermohonanController::class, 'updateStatus'])->name('admin.permohonan.reject');

    // Halaman Data Kategori Permohonan
    Route::get('/permohonan/kategori', [KategoriPermohonanController::class, 'index'])->name('admin.kategori');
    Route::get('/permohonan/kategori/detail/{id}', [KategoriPermohonanController::class, 'show'])->name('admin.kategori.detail');
    Route::get('/permohonan/kategori/add', [KategoriPermohonanController::class, 'add'])->name('admin.kategori.add');
    Route::post('/permohonan/kategori/insert', [KategoriPermohonanController::class, 'insert'])->name('admin.kategori.insert');
    Route::get('/permohonan/kategori/edit/{id}', [KategoriPermohonanController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('/permohonan/kategori/update/{id}', [KategoriPermohonanController::class, 'update'])->name('admin.kategori.update');
    Route::get('/permohonan/kategori/delete/{id}', [KategoriPermohonanController::class, 'destroy'])->name('admin.kategori.delete');

    // Halaman Data User Administrator
    Route::get('/user/admin', [UserAdministratorController::class, 'index'])->name('admin.user.admin');
    Route::get('/user/admin/detail/{id}', [UserAdministratorController::class, 'show'])->name('admin.user.admin.detail');
    Route::get('/user/admin/add', [UserAdministratorController::class, 'add'])->name('admin.user.admin.add');
    Route::post('/user/admin/save', [UserAdministratorController::class, 'store'])->name('admin.user.admin.save');
    Route::get('/user/admin/edit/{id}', [UserAdministratorController::class, 'edit'])->name('admin.user.admin.edit');
    Route::post('/user/admin/update/{id}', [UserAdministratorController::class, 'update'])->name('admin.user.admin.update');
    Route::get('/user/admin/delete/{id}', [UserAdministratorController::class, 'destroy'])->name('admin.user.admin.delete');

    // Halaman Data User Pimpinan
    Route::get('/user/pimpinan', [UserPimpinanController::class, 'index'])->name('admin.user.pimpinan');
    Route::get('/user/pimpinan/detail/{id}', [UserPimpinanController::class, 'show'])->name('admin.user.pimpinan.detail');
    Route::get('/user/pimpinan/add', [UserPimpinanController::class, 'add'])->name('admin.user.pimpinan.add');
    Route::post('/user/pimpinan/save', [UserPimpinanController::class, 'store'])->name('admin.user.pimpinan.save');
    Route::get('/user/pimpinan/edit/{id}', [UserPimpinanController::class, 'edit'])->name('admin.user.pimpinan.edit');
    Route::post('/user/pimpinan/update/{id}', [UserPimpinanController::class, 'update'])->name('admin.user.pimpinan.update');
    Route::get('/user/pimpinan/delete/{id}', [UserPimpinanController::class, 'destroy'])->name('admin.user.pimpinan.delete');

    // Halaman Data User Teknisi
    Route::get('/user/teknisi', [UserTeknisiController::class, 'index'])->name('admin.user.teknisi');
    Route::get('/user/teknisi/detail/{id}', [UserTeknisiController::class, 'show'])->name('admin.user.teknisi.detail');
    Route::get('/user/teknisi/add', [UserTeknisiController::class, 'add'])->name('admin.user.teknisi.add');
    Route::post('/user/teknisi/save', [UserTeknisiController::class, 'store'])->name('admin.user.teknisi.save');
    Route::get('/user/teknisi/edit/{id}', [UserTeknisiController::class, 'edit'])->name('admin.user.teknisi.edit');
    Route::post('/user/teknisi/update/{id}', [UserTeknisiController::class, 'update'])->name('admin.user.teknisi.update');
    Route::get('/user/teknisi/delete/{id}', [UserTeknisiController::class, 'destroy'])->name('admin.user.teknisi.delete');

    // Halaman Data User Pimpinan
    Route::get('/user/adminopd', [AdminOpdController::class, 'index'])->name('admin.user.adminopd');
    Route::get('/user/adminopd/detail/{id}', [AdminOpdController::class, 'show'])->name('admin.user.adminopd.detail');
    Route::get('/user/adminopd/add', [AdminOpdController::class, 'add'])->name('admin.user.adminopd.add');
    Route::post('/user/adminopd/save', [AdminOpdController::class, 'store'])->name('admin.user.adminopd.save');
    Route::get('/user/adminopd/edit/{id}', [AdminOpdController::class, 'edit'])->name('admin.user.adminopd.edit');
    Route::post('/user/adminopd/update/{id}', [AdminOpdController::class, 'update'])->name('admin.user.adminopd.update');
    Route::get('/user/adminopd/delete/{id}', [AdminOpdController::class, 'destroy'])->name('admin.user.adminopd.delete');
});


// * View Admin OPD
Route::group([
    'prefix' => '/adminOpd',
    'middleware' => [
        'auth',
        'role:adminOpd',
    ]
], function () {
    Route::get('/', [Admin_opdHomeController::class, 'index'])->name('adminOpd');

    //Halaman Pedoman Penggunaan
    Route::get('/pedoman', [Admin_opdHomeController::class, 'pedoman'])->name('adminOpd.pedoman');

    // ! TODO : Halaman Data Permohonan (fitur belum complete)
    // Halaman Data Permohonan 
    Route::get('/permohonan', [Admin_opdPermohonanController::class, 'index'])->name('adminOpd.permohonan');
    Route::get('/permohonan/add', [Admin_opdPermohonanController::class, 'add'])->name('adminOpd.permohonan.add');
    Route::post('/permohonan/insert', [Admin_opdPermohonanController::class, 'insert'])->name('adminOpd.permohonan.insert');
    Route::get('/permohonan/detail/{id}', [Admin_opdPermohonanController::class, 'detail'])->name('adminOpd.permohonan.detail');
    Route::get('/permohonan/edit/{id}', [Admin_opdPermohonanController::class, 'edit'])->name('adminOpd.permohonan.edit');
    Route::post('/permohonan/update/{id}', [Admin_opdPermohonanController::class, 'update'])->name('adminOpd.permohonan.update');
    Route::get('/permohonan/delete/{id}', [Admin_opdPermohonanController::class, 'destroy'])->name('adminOpd.permohonan.delete');
    Route::get('/permohonan/send/{id}', [Admin_opdPermohonanController::class, 'apply'])->name('adminOpd.permohonan.send');
    Route::get('/permohonan/view/{id}', [Admin_opdPermohonanController::class, 'viewFile'])->name('adminOpd.permohonan.view');
    Route::get('/permohonan/file/{id}', [Admin_opdPermohonanController::class, 'generateFile'])->name('adminOpd.permohonan.download');
});


// * View User Pimpinan
Route::group([
    'prefix' => '/pimpinan',
    'middleware' => [
        'auth',
        'role:pimpinan',
    ]
], function () {
    Route::get('/', [User_pimpinanHomeController::class, 'index'])->name('pimpinan');

    // Halaman Data Permohonan
    Route::get('/permohonan', [User_pimpinanPermohonanController::class, 'index'])->name('pimpinan.permohonan');
    Route::get('/permohonan/add', [User_pimpinanPermohonanController::class, 'add'])->name('pimpinan.permohonan.add');
    Route::post('/permohonan/insert', [User_pimpinanPermohonanController::class, 'insert'])->name('pimpinan.permohonan.insert');
    Route::get('/permohonan/detail/{id}', [User_pimpinanPermohonanController::class, 'detail'])->name('pimpinan.permohonan.detail');
    Route::get('/permohonan/approve/{id}', [User_pimpinanPermohonanController::class, 'approve'])->name('pimpinan.permohonan.approve');
    Route::get('/permohonan/view/{id}', [User_pimpinanPermohonanController::class, 'viewFile'])->name('pimpinan.permohonan.view');
    Route::get('/permohonan/file/{id}', [User_pimpinanPermohonanController::class, 'generateFile'])->name('pimpinan.permohonan.download');
    Route::get('/permohonan/reject', [User_pimpinanPermohonanController::class, 'updateStatus'])->name('pimpinan.permohonan.reject');
});


// * View User Teknisi
Route::group([
    'prefix' => '/teknisi',
    'middleware' => [
        'auth',
        'role:teknisi',
    ]
], function () {
    Route::get('/', [User_teknisiHomeController::class, 'index'])->name('teknisi');

    // Halaman Data Permohonan
    Route::get('/permohonan', [User_teknisiPermohonanController::class, 'index'])->name('teknisi.permohonan');
    Route::get('/permohonan/add', [User_teknisiPermohonanController::class, 'add'])->name('teknisi.permohonan.add');
    Route::post('/permohonan/insert', [User_teknisiPermohonanController::class, 'insert'])->name('teknisi.permohonan.insert');
    Route::get('/permohonan/detail/{id}', [User_teknisiPermohonanController::class, 'detail'])->name('teknisi.permohonan.detail');
    Route::get('/permohonan/kerjakan/{id}', [User_teknisiPermohonanController::class, 'kerjakan'])->name('teknisi.permohonan.kerjakan');
    Route::get('/permohonan/done/{id}', [User_teknisiPermohonanController::class, 'finish'])->name('teknisi.permohonan.done');
    Route::get('/permohonan/view/{id}', [User_teknisiPermohonanController::class, 'viewFile'])->name('teknisi.permohonan.view');
    Route::get('/permohonan/file/{id}', [User_teknisiPermohonanController::class, 'generateFile'])->name('teknisi.permohonan.download');
    Route::get('/permohonan/reject', [User_teknisiPermohonanController::class, 'updateStatus'])->name('teknisi.permohonan.reject');
});