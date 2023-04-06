<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;

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

// ========================================================================

Route::get('/cls', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// ========================================================================

Route::get('/', function () {
    return view('account.login');
});

// ----------------------

Route::get('/login', [UserController::class, 'display_login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');

// ----------------------

Route::get('/forget_pass', [UserController::class, 'send_email_forget_password']);
Route::get('/ready_forget_pass', [UserController::class, 'set_to_forgetting_password'])->name('admin.ready_forget_pass');
Route::get('/reset_pass', [UserController::class, 'reset_pass_display'])->name('admin.reset_pass');
Route::post('/reset_pass', [UserController::class, 'set_new_pass'])->name('admin.reset_pass_process');

// ========================================================================

Route::get('/e', [StaffController::class, 'export'])->name('export');
Route::get('/te', [StaffController::class, 'display_export'])->name('display_export');

// ========================================================================

/*
|---- ROLE ACCOUNT
|---- 0 = Admin
|---- 1 = Spy Management Material
|---- 2 = Staff Gudang Utama
|---- 3 = Staff Gudang Workshop
|---- 4 = Staff Pengadaan
*/

/*
|---- STATUS MATERIAL
|---- 0 = Akan Datang
|---- 1 = Sampai
|---- 2 = Accept
|---- 3 = Reject
|---- 4 = Dikembalikan
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');    

    // ----------------------

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

    Route::get('/ganti_pass', [UserController::class, 'ganti_pass_display'])->name('admin.ganti_pass');
    Route::post('/ganti_pass', [UserController::class, 'ganti_pass_process'])->name('admin.ganti_pass_process');

    // ----------------------

    Route::get('/list-kedatangan-material', [StaffController::class, 'list_kedatangan_material'])->name('staff.list-kedatangan-material');
    Route::get('/kedatangan-material', [StaffController::class, 'form_kedatangan_material'])->name('staff.form-kedatangan-material');
    Route::post('/kedatangan-material', [StaffController::class, 'form_kedatangan_material_process'])->name('staff.form-kedatangan-material-process');

    Route::get('/list-material-sampai', [StaffController::class, 'list_material_sampai'])->name('staff.list-material-sampai');
    Route::post('/material-sampai', [StaffController::class, 'material_sampai'])->name('staff.material-sampai');

    // ----------------------

    Route::get('/list-notifikasi', [StaffController::class, 'list_notifikasi'])->name('staff.list-notifikasi');
    Route::get('/checklist_notifikasi/{id}', [StaffController::class, 'checklist_notifikasi'])->name('staff.check_notifikasi');

    // ----------------------

    Route::get('/update_status_material/{kode_update}/{id}', [StaffController::class, 'update_status_material'])->name('staff.update-status-material');
    Route::post('/accept_material', [StaffController::class, 'accept_material'])->name('staff.accept-material');
    Route::post('/reject_material', [StaffController::class, 'reject_material'])->name('staff.reject-material');
    Route::post('/return_material', [StaffController::class, 'return_material'])->name('staff.return-material');

    // ----------------------

    Route::get('/list_material_inventory', [StaffController::class, 'list_material_inventory'])->name('staff.list-material-inventory');
});

Route::group(['middleware' => ['auth', 'checkrole:0']], function () {

    Route::get('/list-user', [UserController::class, 'list_user'])->name('admin.list-user');
    Route::get('/delete_user/{id}', [UserController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/edit_role_user/', [UserController::class, 'edit_role_user'])->name('admin.edit_role_user');
    Route::post('/edit_password_user/', [UserController::class, 'edit_password_user'])->name('admin.edit_password_user');

    // ----------------------

    Route::get('/add-account', [UserController::class, 'add_account'])->name('admin.add-account');
    Route::post('/add-account', [UserController::class, 'add_account_process'])->name('admin.add-account-process');
    
});





