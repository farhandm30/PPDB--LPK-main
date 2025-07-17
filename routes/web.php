<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile Routes
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');

// Majors Routes
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors');
Route::get('/jurusan/{kode_jurusan}', [MajorController::class, 'show'])->name('majors.show');

// Contact Routes
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Gallery Routes
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

// Registration Routes
Route::middleware(['register'])->group(function () {
    Route::get('/pendaftaran', [AuthController::class, 'showRegister'])->name('registration');
    Route::post('/pendaftaran', [AuthController::class, 'register'])->name('registration.store');
});

// Article Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// FAQ Routes
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

// Siswa Dashboard Routes
Route::middleware(['auth', 'siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/data-diri', [SiswaDashboardController::class, 'dataDiri'])->name('siswa.data-diri');
    Route::post('/data-diri', [SiswaDashboardController::class, 'updateDataDiri'])->name('siswa.update-data-diri');
    Route::get('/data-orangtua', [SiswaDashboardController::class, 'dataOrangtua'])->name('siswa.data-orangtua');
    Route::post('/data-orangtua', [SiswaDashboardController::class, 'updateDataOrangtua'])->name('siswa.update-data-orangtua');
    Route::get('/berkas', [SiswaDashboardController::class, 'berkas'])->name('siswa.berkas');
    Route::post('/berkas', [SiswaDashboardController::class, 'uploadBerkas'])->name('siswa.upload-berkas');
    Route::get('/berkas/view/{type}', [SiswaDashboardController::class, 'viewBerkas'])->name('siswa.view-berkas');
    Route::get('/berkas/download/{type}', [SiswaDashboardController::class, 'downloadBerkas'])->name('siswa.download-berkas');
    Route::get('/hasil', [SiswaDashboardController::class, 'hasil'])->name('siswa.hasil');
    Route::get('/download-bukti-pendaftaran', [SiswaDashboardController::class, 'generateBuktiPendaftaran'])->name('siswa.download-bukti-pendaftaran');
    Route::get('/download-surat-pernyataan', [SiswaDashboardController::class, 'generateSuratPernyataan'])->name('siswa.download-surat-pernyataan');
    Route::post('/upload-surat-pernyataan', [SiswaDashboardController::class, 'uploadSuratPernyataan'])->name('siswa.upload-surat-pernyataan');
});

// Admin Auth Routes
Route::get('/login', function () {
    return redirect()->route('auth.login');
})->name('login');

// Unified Auth Routes
Route::get('/auth/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login.post');
Route::post('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/auth/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register.post');
Route::get('/download-bukti', [App\Http\Controllers\AuthController::class, 'downloadBuktiPendaftaran'])->name('download.bukti');

// Admin Dashboard Route
Route::get('/dashboard', function () {
    return redirect()->route('filament.admin.pages.dashboard');
})->name('dashboard');
