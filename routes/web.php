<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth.check:admin']], function () {  
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Surat
    Route::get('/admin/surat', [AdminController::class, 'surat'])->name('admin.surat');
    Route::get('/admin/surat/create', [AdminController::class, 'suratCreate'])->name('admin.surat.create');
    Route::post('/admin/surat/post', [AdminController::class, 'suratCreatePost'])->name('admin.surat.create.post');
    Route::post('/admin/surat/filter', [AdminController::class, 'suratFilterPost'])->name('admin.surat.filter');
    Route::get('/admin/surat/detail/{id}', [AdminController::class, 'suratDetail'])->name('admin.surat.detail');
    Route::get('/admin/surat/edit/{id}', [AdminController::class, 'suratCreate'])->name('admin.surat.edit');
    Route::post('/admin/surat/edit/post', [AdminController::class, 'suratEditPost'])->name('admin.surat.edit.post');
    Route::post('/admin/surat/delete', [AdminController::class, 'suratDeletePost'])->name('admin.surat.delete');



    Route::get('/admin/surat/disposisi', [AdminController::class, 'suratCreate'])->name('admin.surat.disposisi');
    Route::get('/admin/surat/pending', [AdminController::class, 'suratCreate'])->name('admin.surat.pending');
});
