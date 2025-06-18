<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KronologiController;
use App\Http\Controllers\MasterProsesController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KategoriKronologiController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\FlowProsesController;
use App\Http\Controllers\TbCekqtyController;
use App\Http\Controllers\TbCekqtyRossetController;
use App\Models\User;
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
    Route::get('reportData', [TbCekqtyRossetController::class, 'reportData'])->name('reportData');
    Route::get('reportData/{bagian}', [TbCekqtyRossetController::class, 'dataByBagian'])
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->name('reportDatabyBagian');
    Route::prefix('{bagian}')
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->group(function () {
            Route::resource('tb_cekqty_rosset', TbCekqtyRossetController::class)
                ->parameters(['tb_cekqty_rosset' => 'rosset'])
                ->names([
                    'index'   => 'tb_cekqty_rosset.index',
                    'create'  => 'tb_cekqty_rosset.create',
                    'store'   => 'tb_cekqty_rosset.store',
                    'update'  => 'tb_cekqty_rosset.update',
                ]);
        });

    Route::delete(
        'reportData/{bagian}/{id}',
        [TbCekqtyRossetController::class, 'destroy']
    )
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->where('id', '[0-9]+')
        ->name('reportData.destroy');
    Route::get('reportData/{bagian}/{id}', [TbCekqtyRossetController::class, 'edit'])
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->where('id', '[0-9]+')
        ->name('reportData.edit');
    Route::put('reportData/{bagian}/{id}', [TbCekqtyRossetController::class, 'update'])
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->where('id', '[0-9]+')
        ->name('reportData.update');

    Route::resource('mesin', TbCekqtyController::class);
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'indexUser'])->name('user.dashboard');
    Route::get('/kronologi', [KronologiController::class, 'index'])->name('user.kronologi.index');
});

Route::middleware(['auth', 'role:monitoring'])->prefix('monitoring')->group(function () {
    Route::get('/dashboard', [UserController::class, 'indexMonitoring'])->name('monitoring.dashboard');
    Route::get('/kronologi', [KronologiController::class, 'index'])->name('kronologi.index');
    Route::resource('/masterproses', MasterProsesController::class);
    Route::resource('/users', UserController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('kategori_kronologi', KategoriKronologiController::class);
    Route::resource('area', AreaController::class);
    Route::resource('flowproses', FlowProsesController::class)->parameters(['flowproses' => 'main_flowproses']);
    Route::post('flowproses/import', [FlowProsesController::class, 'import'])->name('flowproses.import');
});

// Boleh multi-role
Route::middleware(['auth', 'role:user,monitoring'])->group(function () {
    Route::get('/shared', function () {
        return 'Shared Area';
    });
});

require __DIR__ . '/auth.php';
