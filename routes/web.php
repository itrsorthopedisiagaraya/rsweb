<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Compro\DokterController as DokterCompro;
use App\Http\Controllers\Admin\PostinganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Compro\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Compro\KarirController;
use App\Http\Controllers\Admin\KarirController as AdminKarirController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PendaftaranBerobatController;
use App\Http\Controllers\Compro\PostController;
use App\Http\Controllers\Middle\ComproApiController;
use App\Http\Controllers\PartnerAsuransiController;
use App\Http\Controllers\PromoController;
use App\Models\LayananUnggulan;

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

// Localization
Route::get('/lang/{language}', [LocalizationController::class, '__invoke'])->name('lang');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/sambutan',[HomeController::class,'sambutan'])->name('sambutan');
Route::get('/doctors',[DokterCompro::class,'index'])->name('doctorsToday');
Route::get('/doctors/{hari}',[DokterCompro::class,'index'])->name('doctors');
Route::get('/doctors-profile',[DokterCompro::class,'profile'])->name('doctorsProfile');
Route::post('/doctors-profile',[DokterCompro::class,'profile'])->name('doctorsProfileFilter');
Route::get('/doctor-profile/{id}', [DokterCompro::class, 'personal'])->name('doctorProfile');

Route::post('/create-spesialis', [DokterCompro::class, 'createSpesialis'])->name('createSpesialis');

Route::prefix('blog')->group(function () {
    Route::get('/', [HomeController::class,'blog'])->name('blog');
    Route::get('/details/{slug}', [HomeController::class, 'blogDetails'])->name('blog.details');
});

Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/karir-info',[KarirController::class,'index'])->name('karir');
Route::post('/karir/get-all-data', [AdminKarirController::class, 'getAllData'])->name('karir.admin.getAllData');
Route::get('/post/{id}', [PostController::class, 'index'])->name('post');

Route::get('/promo/{slug}', [PromoController::class, 'promotion'])->name('promotion');

Route::get('/layanan-unggulan/{id}', [HomeController::class, 'layananDetail'])->name('layananDetail');

Route::get('/layanan-medis/detail/{slug}', [LayananController::class, 'layananMedis'])->name('layananMedis');

Route::get('/promo', [HomeController::class, 'promo'])->name('promo');

// API
Route::get('/get-dokter-api', [ComproApiController::class, 'getDokter'])->name('get.dokter.api');
Route::get('/get-dokter-jadwal-api', [ComproApiController::class, 'getJadwal'])->name('get.dokter.jadwal.api');
Route::get('/get-filter-dokter-jadwal-api/{hari}', [ComproApiController::class, 'getJadwalFilter'])->name('get.filter.jadwal.api');
Route::get('/get-postingan-api', [ComproApiController::class, 'getPostingan'])->name('get.postingan.api');

Route::prefix('dokter')->group(function() {
    Route::get('/jadwal/hari-ini/{hari}', [DokterController::class,'infoJadwalHariIni']);
});
// Auth
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/daftar', [AuthController::class, 'create'])->name('daftar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/signout', [AuthController::class, 'signout'])->name('signout');

    Route::post('/daftar-berobat', [HomeController::class, 'daftarBerobat'])->name('daftarBerobat');


    Route::middleware(['admin'])->group(function() {
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        });
    
        Route::prefix('dokter')->group(function () {
            Route::get('/', [DokterController::class, 'index'])->name('dokter');
            Route::get('/jadwal', [DokterController::class, 'jadwal'])->name('dokter.jadwal');
            Route::get('/create', [DokterController::class, 'create'])->name('dokter.create');
            Route::get('/edit/{id}', [DokterController::class, 'edit'])->name('dokter.edit');
            Route::post('/store', [DokterController::class, 'store'])->name('dokter.store');
            Route::put('/update', [DokterController::class, 'update'])->name('dokter.update');
            Route::delete('/delete/{id}', [DokterController::class, 'destroy'])->name('dokter.delete');
            Route::prefix('jadwal')->group(function () {
                Route::get('/edit/{id}', [DokterController::class, 'editJadwal'])->name('dokter.jadwal.edit');
                Route::get('/reset/{id}', [DokterController::class, 'resetJadwal'])->name('dokter.jadwal.reset');
                Route::post('/update', [DokterController::class, 'updateJadwal'])->name('dokter.jadwal.update');
            });
        });

        Route::prefix('kategori')->group(function() {
            Route::get('/', [KategoriController::class, 'index'])->name('kategori');
            Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
            Route::post('/getAllData', [KategoriController::class, 'getAllData'])->name('kategori.getAllData');
            Route::get('/getById/{id}', [KategoriController::class, 'getById'])->name('kategori.by.id');
            Route::post('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::get('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
        });
    
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::put('/update', [UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        });

        Route::prefix('postingan')->group(function() {
            Route::get('/', [PostinganController::class, 'index'])->name('postingan');
            Route::get('/create', [PostinganController::class, 'create'])->name('postingan.create');
            Route::get('/edit/{id}', [PostinganController::class, 'edit'])->name('postingan.edit');
            Route::post('/store', [PostinganController::class, 'store'])->name('postingan.store');
            Route::put('/update', [PostinganController::class, 'update'])->name('postingan.update');
            Route::post('/delete', [PostinganController::class, 'delete'])->name('postingan.delete');

            Route::get('/getBerita', [PostinganController::class, 'getDataBerita'])->name('getBerita');
        });

        Route::prefix('karir')->group(function() {
            Route::get('/', [AdminKarirController::class, 'index'])->name('karir.admin');
            Route::get('/create', [AdminKarirController::class, 'create'])->name('karir.admin.create');
            Route::get('/edit/{id}', [AdminKarirController::class, 'edit'])->name('karir.admin.edit');
            Route::post('/store', [AdminKarirController::class, 'store'])->name('karir.admin.store');
            Route::post('/update', [AdminKarirController::class, 'update'])->name('karir.admin.update');
            Route::delete('/destroy/{id}', [AdminKarirController::class, 'destroy'])->name('karir.admin.destroy');
        });

        Route::prefix('list-promo')->group(function() {
            Route::get('/', [PromoController::class, 'list'])->name('listPromo');
            Route::get('/create', [PromoController::class, 'create'])->name('listPromo.create');
            Route::post('/store', [PromoController::class, 'store'])->name('listPromo.store');
            Route::delete('/delete/{id}', [PromoController::class, 'destroy'])->name('listPromo.delete');
            Route::get('/edit/{id}', [PromoController::class, 'edit'])->name('listPromo.edit');
            Route::post('/update', [PromoController::class, 'update'])->name('listPromo.update');
        });

        Route::prefix('layanan')->group(function() {
            Route::get('/', [LayananController::class, 'index'])->name('layanan');
            Route::get('/create', [LayananController::class, 'create'])->name('layananCreate');
            Route::post('/store', [LayananController::class, 'store'])->name('layananStore');
            Route::post('/getLayanan', [LayananController::class, 'getLayanan'])->name('getLayanan');
        });

        Route::prefix('layanan-medis')->group(function() {
            Route::get('/list', [LayananController::class, 'listLayananMedis'])->name('listLayananMedis');
            Route::get('/create', [LayananController::class, 'createLayananMedis'])->name('listLayananMedis.create');
            Route::post('/store', [LayananController::class, 'storeLayananMedis'])->name('listLayananMedis.store');
            Route::post('/delete', [LayananController::class, 'deleteLayananMedis'])->name('listLayananMedis.delete');
            Route::get('/edit/{id}', [LayananController::class, 'editLayananMedis'])->name('listLayananMedis.edit');
            Route::post('/update/{id}', [LayananController::class, 'updateLayananMedis'])->name('listLayananMedis.update');
            Route::get('/getDataLayananMedis', [LayananController::class, 'getDataLayananMedis'])->name('listLayananMedis.getData');
        });

        Route::prefix('pendaftaran-berobat')->group(function() {
            Route::get('/', [PendaftaranBerobatController::class, 'index'])->name('listPendaftaranBerobat');
            Route::get('/detail/{id}', [PendaftaranBerobatController::class, 'pasienDetail'])->name('detailPasien');
        });

        Route::prefix('partner')->group(function() {
            Route::get('/', [PartnerAsuransiController::class, 'index'])->name('partnerAsuransi');
            Route::get('/create',[PartnerAsuransiController::class,'create'])->name('partner-asuransi.create');
            Route::get('/edit/{id}',[PartnerAsuransiController::class,'edit'])->name('partner-asuransi.edit');
            Route::post('/store',[PartnerAsuransiController::class,'store'])->name('partner-asuransi.store');
            Route::post('/update/{id}',[PartnerAsuransiController::class,'update'])->name('partner-asuransi.update');
            Route::delete('/delete/{id}',[PartnerAsuransiController::class,'delete'])->name('partner-asuransi.delete');
        });
    });

    Route::prefix('api')->group(function() {
        Route::post('/dokter-jadwal', [DokterController::class, 'apiDokterJadwal'])->name('api.dokter.jadwal');
        Route::post('/dokter-jadwal-today', [DokterController::class, 'apiDokterJadwalToday'])->name('apiDokterJadwalToday');
    });

    Route::post('/upload', [PostinganController::class, 'upload'])->name('ckeditor.upload');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// });

