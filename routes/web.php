<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Kategori;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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



// Fungsi Profile (Breeze)
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tanpa Auth
Route::get('/', [AppController::class, 'index'])->name('home');

// Dashboard User View
Route::get('/dashboard/pertanyaan', [AppController::class, 'dashboard_post'])->middleware(['auth', 'verified', 'role:pengguna'])->name('dashboard');
Route::get('/dashboard/jawaban', [AppController::class, 'dashboard_jawaban'])->middleware(['auth', 'verified', 'role:pengguna'])->name('dashboard_jawaban');

// Post CRUD
Route::get('/create', [AppController::class, 'create_post'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.create');
Route::post('/index', [PostController::class, 'store'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.store');
Route::get('/dashboard/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.edit');
Route::put('/dashboard/{post}/update', [PostController::class, 'update'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.update');
Route::delete('/dashboard/{post}/destroy', [PostController::class, 'destroy'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('post.destroy');

// Sudpend Post
Route::post('/suspend/post/{id}', [PostController::class, 'suspend'])->middleware(['auth', 'verified', 'role:admin'])->name('suspend.post');
Route::post('/unsuspend/post/{id}', [PostController::class, 'unsuspend'])->middleware(['auth', 'verified', 'role:admin'])->name('unsuspend.post');
Route::get('/suspend/{post:slug}', [PostController::class, 'suspend_view'])->name('suspend');

// Report Post
Route::post('/report/post/{id}', [PostController::class, 'report'])->middleware(['auth', 'verified', 'role:admin|pengguna'])->name('report.post');
Route::post('/batal-report/post/{id}', [PostController::class, 'batal_report'])->middleware(['auth', 'verified', 'role:admin'])->name('batal-report.post');


// Detail Post
Route::get('/post/{post:slug}', [AppController::class, 'detail_post'])->middleware(['status'])->name('detail_post');

// Post Tanpa Jawaban (Tanpa Auth)
Route::get('/jawab', [AppController::class, 'jawab_view'])->name('jawab');

// Pedoman Komunitas
Route::get('/pedoman-komunitas', [AppController::class, 'pedoman'])->name('pedoman');

// Ban Explanation
Route::get('/suspend', [AppController::class, 'suspend_exp'])->name('suspend');

// Jawaban CRUD
Route::post('/', [JawabanController::class, 'store'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban_store');
Route::put('/jawaban/{jawaban}/edit', [JawabanController::class, 'update'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban.update');
Route::delete('/jawaban/{jawaban}/destroy', [JawabanController::class, 'destroy'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('jawaban.destroy');
Route::post('/verifikasi-jawaban/{id}', [JawabanController::class, 'verifikasi'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('verifikasi.jawaban');
Route::post('/batal-verifikasi-jawaban/{id}', [JawabanController::class, 'batal_verifikasi'])->middleware(['auth', 'verified', 'role:pengguna|admin'])->name('batal.verifikasi.jawaban');
Route::post('/ban-jawaban/{id}', [JawabanController::class, 'ban_jawaban'])->middleware(['auth', 'verified', 'role:admin'])->name('ban.jawaban');
Route::post('/batal-ban-jawaban/{id}', [JawabanController::class, 'batal_ban_jawaban'])->middleware(['auth', 'verified', 'role:admin'])->name('batal.ban.jawaban');
Route::post('/report-jawaban/{id}', [JawabanController::class, 'report_jawaban'])->middleware(['auth', 'verified', 'role:admin|pengguna'])->name('report.jawaban');
Route::post('/batal-report-jawaban/{id}', [JawabanController::class, 'batal_report_jawaban'])->middleware(['auth', 'verified', 'role:admin'])->name('batal.report.jawaban');

// Dashboard Admin View
Route::get('/dashboard/admin', [AppController::class, 'dashboard_admin'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.admin');
Route::get('/dashboard/kategori', [AppController::class, 'dashboard_kategori'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.kategori');
Route::get('/dashboard/laporan', [AppController::class, 'dashboard_laporan'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.laporan');
Route::get('/dashboard/laporan/jawaban', [AppController::class, 'dashboard_laporan_jawaban'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.laporan.jawaban');
Route::get('/dashboard/laporan/komentar ', [AppController::class, 'dashboard_laporan_komentar'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard.laporan.komentar');

// Kategori CRUD
Route::post('/dashboard/kategori/create', [KategoriController::class, 'store'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.store');
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.edit');
Route::put('/kategori/{kategori}/update', [KategoriController::class, 'update'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.update');
Route::delete('/kategori/{kategori}/destroy', [KategoriController::class, 'destroy'])->middleware(['auth', 'verified', 'role:admin'])->name('kategori.destroy');

// Kategori View (Tanpa Auth)
Route::get('/kategori', [AppController::class, 'kategori'])->name('kategoris');
Route::get('/?kategori={kategori}', [AppController::class, 'kategori_detail']);

// Fungsi Ckeditor
Route::post('/ckeditor/upload', [JawabanController::class, 'upload'])->name('ckeditor.upload');

require __DIR__.'/auth.php';
