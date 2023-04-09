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

Route::get('/exp_db/{kode}', [StaffController::class, 'export_db'])->name('export_db');

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
|---- 0 = Sampai
|---- 1 = On Inspection
|---- 2 = Accept
|---- 3 = Reject
|---- 4 = Dikembalikan
*/

/*
|---- STATUS PENGGUNAAN MATERIAL OLEH GUDANG KECIL
|---- 0 = Belum Acc
|---- 1 = Acc
|---- 2 = Reject
*/

/*
|---- STATUS PENGGUNAAN MATERIAL BUFFER
|---- 0 = Penggunaan ke Gudang Kecil
|---- 1 = Penggunaan ke Staff Pekerja
*/

/*
|---- STATUS REQUEST RESTOCK
|---- 0 = Belum Acc
|---- 1 = Acc
|---- 2 = Reject
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
    Route::post('update_stock_material_inventory', [StaffController::class, 'update_stock_material_inventory'])->name('staff.update-stock-material_inventory');
    Route::get('/form_penggunaan_material', [StaffController::class, 'form_penggunaan_material'])->name('staff.form-penggunaan-material');
    Route::post('/form_penggunaan_material', [StaffController::class, 'form_penggunaan_material_buffer_process'])->name('staff.form-penggunaan-material-buffer-process');
    Route::get('/hapus_penggunaan_material_raw/{id}', [StaffController::class, 'hapus_penggunaan_material_raw'])->name('staff.hapus-penggunaan-material-raw');

    // ----------------------

    Route::post('/acc_penggunaan_gudang_kecil', [StaffController::class, 'acc_penggunaan_gudang_kecil'])->name('staff.acc-penggunaan-gudang-kecil');
    Route::post('/reject_penggunaan_gudang_kecil', [StaffController::class, 'reject_penggunaan_gudang_kecil'])->name('staff.reject-penggunaan-gudang-kecil');

    // ----------------------

    Route::get('/form_request_restock_material_raw', [StaffController::class, 'form_request_restock_material_raw'])->name('staff.form-request-restock-material-raw');
    Route::post('/form_request_restock_material_raw', [StaffController::class, 'form_request_restock_material_raw_process'])->name('staff.form-request-restock-material-raw-process');
    Route::get('/hapus_request_restock_material_raw/{id}', [StaffController::class, 'hapus_request_restock_material_raw'])->name('staff.hapus-request-restock-material-raw');

    // ----------------------

    Route::get('/form_penggunaan_material_process', [StaffController::class, 'form_penggunaan_material_process'])->name('staff.form-penggunaan-material-process');
    Route::get('/list_penggunaan_material', [StaffController::class, 'list_penggunaan_material'])->name('staff.list-penggunaan-material');

    Route::get('/form_request_restock_material', [StaffController::class, 'form_request_restock_material'])->name('staff.form-request-restock-material');
    Route::get('/list_request_restock_material', [StaffController::class, 'list_request_restock_material_raw'])->name('staff.list-request-restock-material');
    Route::post('/acc_request_restock_material', [StaffController::class, 'acc_request_restock_material'])->name('staff.acc-request-restock-material');
    Route::post('/reject_request_restock_material', [StaffController::class, 'reject_request_restock_material'])->name('staff.reject-request-restock-material');

    // ----------------------

    Route::get('/form_penggunaan_material_gudang_kecil', [StaffController::class, 'form_penggunaan_material_gudang_kecil'])->name('staff.form-penggunaan-material-gudang-kecil');
    Route::post('/form_penggunaan_material_gudang_kecil', [StaffController::class, 'form_penggunaan_material_gudang_kecil_process'])->name('staff.form-penggunaan-material-gudang-kecil-process');
    Route::get('/form_penggunaan_material_gudang_kecil_process_final', [StaffController::class, 'form_penggunaan_material_gudang_kecil_process_final'])->name('staff.form-penggunaan-material-gudang-kecil-process-final');

    // ----------------------

    Route::get('/list_penggunaan_material_gudang_kecil', [StaffController::class, 'list_penggunaan_material_gudang_kecil'])->name('staff.list-penggunaan-material-gudang-kecil');
    Route::post('/acc_penggunaan_material_gudang_kecil', [StaffController::class, 'acc_penggunaan_material_gudang_kecil'])->name('staff.acc-penggunaan-material-gudang-kecil');
    Route::post('/reject_penggunaan_material_gudang_kecil', [StaffController::class, 'reject_penggunaan_material_gudang_kecil'])->name('staff.reject-penggunaan-material-gudang-kecil');
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





