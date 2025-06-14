<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KronologiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KategoriKronologiController;
use App\Http\Controllers\AreaController;
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

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/kronologi', [KronologiController::class, 'index'])->name('user.kronologi.index');
});

Route::middleware(['auth', 'role:monitoring'])->prefix('monitoring')->group(function () {
    Route::get('/dashboard', [UserController::class, 'indexMonitoring'])->name('monitoring.dashboard');
    Route::get('/kronologi', [KronologiController::class, 'index'])->name('kronologi.index');
    
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('kategori_kronologi', KategoriKronologiController::class);
    Route::resource('area', AreaController::class);
});

// Boleh multi-role
Route::middleware(['auth', 'role:user,monitoring'])->group(function () {
    Route::get('/shared', function () {
        return 'Shared Area';
    });
});

require __DIR__.'/auth.php';
