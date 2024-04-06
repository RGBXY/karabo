<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Kategori;
use App\Models\Post;
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

Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('/dashboard/pertanyaan', [AppController::class, 'dashboard_post'])->middleware(['auth', 'verified', 'role:pengguna'])->name('dashboard');
Route::get('/dashboard/jawaban', [AppController::class, 'dashboard_jawaban'])->middleware(['auth', 'verified', 'role:pengguna'])->name('dashboard_jawaban');

Route::get('/dashboard/create', [PostController::class, 'create'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.create');
Route::post('/index', [PostController::class, 'store'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.store');
Route::get('/dashboard/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.edit');
Route::put('/dashboard/{post}/update', [PostController::class, 'update'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.update');
Route::delete('/dashboard/{post}/destroy', [PostController::class, 'destroy'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.destroy');

Route::post('/', [JawabanController::class, 'store'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban_store');
Route::put('/jawaban/{jawaban}/edit', [JawabanController::class, 'update'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban.update');
Route::delete('/jawaban/{jawaban}/destroy', [JawabanController::class, 'destroy'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban.destroy');

Route::get('/dashboard-admin', [AppController::class, 'dashboard_admin'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.admin');
Route::get('/dashboard-kategori', [AppController::class, 'dashboard_kategori'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.kategori');

Route::get('/dashboard-admin/add-kategori', [KategoriController::class, 'create'])->middleware(['auth', 'verified', 'role:admin'])->name('post.kategori');
Route::post('/dashboard-kategori', [KategoriController::class, 'store'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.store');
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.edit');
Route::put('/kategori/{kategori}/update', [KategoriController::class, 'update'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.update');
Route::delete('/kategori/{kategori}/destroy', [KategoriController::class, 'destroy'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.destroy');

Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategoris');

Route::get('/kategori={kategori:slug}', [KategoriController::class, 'kategori_detail']);

Route::get('/jawab', [AppController::class, 'jawab_view'])->name('jawab');

Route::get('ckeditor/upload', [AppController::class, 'detail_post'])->name('ckeditor.upload');

Route::get('/post/{post:slug}', [AppController::class, 'detail_post'])->name('detail_post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
