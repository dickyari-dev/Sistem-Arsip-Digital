<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CamatController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route AuthController
Route::get('/', [AuthController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/surat/detail/{slug}', [AuthController::class, 'suratDetail'])->name('surat.detail');
// web.php
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'profileUpdate'])->name('profile.update');

Route::group(['middleware' => ['auth.check:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Surat
    Route::get('/admin/surat', [AdminController::class, 'surat'])->name('admin.surat');
    Route::get('/admin/surat/create', [AdminController::class, 'suratCreate'])->name('admin.surat.create');
    Route::post('/admin/surat/post', [AdminController::class, 'suratCreatePost'])->name('admin.surat.create.post');
    Route::post('/admin/surat/filter', [AdminController::class, 'suratFilterPost'])->name('admin.surat.filter');
    Route::get('/admin/surat/edit/{slug}', [AdminController::class, 'suratEdit'])->name('admin.surat.edit');
    Route::post('/admin/surat/edit/post', [AdminController::class, 'suratEditPost'])->name('admin.surat.edit.post');
    Route::post('/admin/surat/delete', [AdminController::class, 'suratDeletePost'])->name('admin.surat.delete');

    Route::get('/admin/surat/disposisi', [AdminController::class, 'suratDisposisi'])->name('admin.surat.disposisi');
    Route::get('/admin/surat/pending', [AdminController::class, 'suratPending'])->name('admin.surat.pending');
    Route::get('/admin/surat/masuk', [AdminController::class, 'suratMasuk'])->name('admin.surat.masuk');
    Route::get('/admin/surat/keluar', [AdminController::class, 'suratKeluar'])->name('admin.surat.keluar');


    // Admin Surat
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/admin/user/filter', [AdminController::class, 'userFilterPost'])->name('admin.user.filter');
    Route::get('/admin/user/create', [AdminController::class, 'userCreate'])->name('admin.user.create');
    Route::post('/admin/user/create/post', [AdminController::class, 'userCreatePost'])->name('admin.user.create.post');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'userEdit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [AdminController::class, 'update'])->name('admin.user.update');
    Route::post('/admin/user/edit/post', [AdminController::class, 'userEditPost'])->name('admin.user.edit.post');
    Route::post('/admin/user/delete', [AdminController::class, 'userDeletePost'])->name('admin.user.delete');

    Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/admin/category/create', [AdminController::class, 'categoryCreate'])->name('admin.category.create');
    Route::post('/admin/category/store', [AdminController::class, 'categoryStore'])->name('categories.store');
    Route::put('/categories/update/{id}', [AdminController::class, 'categoryUpdate'])->name('categories.update');
    Route::delete('/categories/destroy/{id}', [AdminController::class, 'categoryDestroy'])->name('categories.destroy');
});

Route::group(['middleware' => ['auth.check:camat']], function () {
    Route::get('/camat/dashboard', [CamatController::class, 'dashboard'])->name('camat.dashboard');
    Route::post('/camat/surat/filter', [CamatController::class, 'suratFilterPost'])->name('camat.surat.filter');
    Route::get('/camat/surat', [CamatController::class, 'surat'])->name('camat.surat');
    Route::get('/camat/surat/disposisi', [CamatController::class, 'suratDisposisi'])->name('camat.surat.disposisi');
    Route::get('/camat/surat/pending', [CamatController::class, 'suratPending'])->name('camat.surat.pending');
    Route::post('/camat/surat/revisi/add', [CamatController::class, 'revisiSurat'])->name('camat.surat.revisi.add');

    Route::post('/camat/disposisi', [CamatController::class, 'disposisi'])->name('camat.disposisi');
    Route::post('/camat/disposisi/batal', [CamatController::class, 'disposisiBatal'])->name('camat.batal-disposisi');

    Route::post('/camat/user/filter', [CamatController::class, 'userFilterPost'])->name('camat.user.filter');

    Route::get('/camat/surat/masuk', [CamatController::class, 'suratMasuk'])->name('camat.surat.masuk');
    Route::get('/camat/surat/keluar', [CamatController::class, 'suratKeluar'])->name('camat.surat.keluar');

});

Route::group(['middleware' => ['auth.check:pegawai']], function () {
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'dashboard'])->name('pegawai.dashboard');
    Route::get('/pegawai/surat', [PegawaiController::class, 'surat'])->name('pegawai.surat');
    Route::post('/pegawai/surat/dibaca', [PegawaiController::class, 'suratDibaca'])->name('pegawai.surat.dibaca');
});
