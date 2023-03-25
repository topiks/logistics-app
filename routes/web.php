<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

// ========================================================================

/*
|---- 0 = Admin
|---- 1 = Spy Management Material
|---- 2 = Staff Gudang Utama
|---- 3 = Staff Gudang Workshop
|---- 4 = Staff Pengadaan
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');    
});

Route::group(['middleware' => ['auth', 'checkrole:0']], function () {

    Route::get('/list-user', [UserController::class, 'list_user'])->name('admin.list-user');
    Route::get('/delete_user/{id}', [UserController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/edit_role_user/', [UserController::class, 'edit_role_user'])->name('admin.edit_role_user');
    Route::post('/edit_password_user/', [UserController::class, 'edit_password_user'])->name('admin.edit_password_user');

    Route::get('/add-account', [UserController::class, 'add_account'])->name('admin.add-account');
    Route::post('/add-account', [UserController::class, 'add_account_process'])->name('admin.add-account-process');
    
});





