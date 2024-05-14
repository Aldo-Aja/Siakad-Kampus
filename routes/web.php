<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\ProgramStudyController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\KrsController;
use App\Http\Controllers\Admin\KhsController;
use App\Http\Controllers\Admin\InputNilaiController;
use App\Http\Controllers\Admin\TranskripNilaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // Jurusan CRUD
    Route::resource('jurusan', JurusanController::class)->except('show');
    Route::resource('program_study', ProgramStudyController::class)->except('show');
    Route::resource('mata_kuliah', MataKuliahController::class)->except('show');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('tahun_akademik', TahunAkademikController::class);
    
    // KRS
    Route::get('krs/create/{nim}/{tahun_akademik}', [KrsController::class, 'create'])->name('krs.create');
    Route::get('krs', [KrsController::class, 'index'])->name('krs.index');
    Route::post('krs', [KrsController::class, 'find'])->name('krs.find');
    Route::post('krs/store', [KrsController::class, 'store'])->name('krs.store');
    Route::get('krs/{krs:id}/edit', [KrsController::class, 'edit'])->name('krs.edit');
    Route::put('krs/{krs:id}', [KrsController::class, 'update'])->name('krs.update');
    Route::delete('krs/{krs:id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    
    // KHS
    Route::get('khs', [KhsController::class, 'index'])->name('khs.index');
    Route::post('khs', [KhsController::class, 'find'])->name('khs.find');
    
    // Input Nilai
    Route::get('input_nilai', [InputNilaiController::class, 'index'])->name('input_nilai.index');
    Route::post('input_nilai', [InputNilaiController::class, 'all'])->name('input_nilai.all');
    Route::post('input_nilai/store', [InputNilaiController::class, 'store'])->name('input_nilai.store');
    
    // Transkrip Nilai
    Route::get('transkrip_nilai', [TranskripNilaiController::class, 'index'])->name("transkrip_nilai.index");
    Route::post('transkrip_nilai', [TranskripNilaiController::class, 'find'])->name("transkrip_nilai.find");

    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});