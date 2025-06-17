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
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'indexUser'])->name('user.dashboard');
    Route::get('/kronologi', [KronologiController::class, 'index'])->name('user.kronologi.index');
    // Route::get('{bagian}', [TbCekqtyRossetController::class, 'loadByBagian'])
    //     ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']);
    // 1) First, capture the dynamic “bagian” (rosso, setting, etc):
    Route::prefix('{bagian}')
        ->whereIn('bagian', [
            'rosso',
            'setting',
            'gudang',
            'handprint',
            'jahit',
            'perbaikan'
        ])
        ->group(function () {

            // 2) Now register your resource under that:
            Route::resource('cekqty_rosset', TbCekqtyRossetController::class)
                // rename the {cekqty_rosset} param to {rosset}
                ->parameters(['cekqty_rosset' => 'rosset'])
                // optionally give all your route names here
                ->names([
                    'index'   => 'cekqty_rosset.index',
                    'show'    => 'cekqty_rosset.show',
                    'create'  => 'cekqty_rosset.create',
                    'store'   => 'cekqty_rosset.store',
                    'edit'    => 'cekqty_rosset.edit',
                    'update'  => 'cekqty_rosset.update',
                    'destroy' => 'cekqty_rosset.destroy',
                ]);
        });
    Route::post('/setting/storeSetting/{bagian}', [TbCekqtyRossetController::class, 'storeSetting'])
        ->name('user.setting.storeSetting');
    Route::post('gudang/storeGudang/{bagian}', [TbCekqtyRossetController::class, 'storeGudang'])
        ->name('user.gudang.storeGudang');
    Route::post('handprint/storeHandprint/{bagian}', [TbCekqtyRossetController::class, 'storeHandprint'])
        ->name('user.handprint.storeHandprint');
    Route::post('jahit/storeJahit/{bagian}', [TbCekqtyRossetController::class, 'storeJahit'])
        ->name('user.jahit.storeJahit');
    Route::post('perbaikan/storePerbaikan/{bagian}', [TbCekqtyRossetController::class, 'storePerbaikan'])
        ->name('user.perbaikan.storePerbaikan');
    
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
    // Route::get('{bagian}', [TbCekqtyRossetController::class, 'loadByBagian'])
    //     ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan']);
    Route::prefix('{bagian}')
        ->whereIn('bagian', ['rosso', 'setting', 'gudang', 'handprint', 'jahit', 'perbaikan'])
        ->group(function () {
            Route::resource('tb_cekqty_rosset', TbCekqtyRossetController::class)
                ->parameters(['tb_cekqty_rosset' => 'rosset'])
                ->names([
                    'index'   => 'tb_cekqty_rosset.index',
                    'show'    => 'tb_cekqty_rosset.show',
                    'create'  => 'tb_cekqty_rosset.create',
                    'store'   => 'tb_cekqty_rosset.store',
                    'edit'    => 'tb_cekqty_rosset.edit',
                    'update'  => 'tb_cekqty_rosset.update',
                    'destroy' => 'tb_cekqty_rosset.destroy',
                ]);
        });
    Route::post('/setting/storeSetting/{bagian}', [TbCekqtyRossetController::class, 'storeSetting'])
        ->name('setting.storeSetting');
    Route::post('gudang/storeGudang/{bagian}', [TbCekqtyRossetController::class, 'storeGudang'])
        ->name('gudang.storeGudang');
    Route::post('handprint/storeHandprint/{bagian}', [TbCekqtyRossetController::class, 'storeHandprint'])
        ->name('handprint.storeHandprint');
    Route::post('jahit/storeJahit/{bagian}', [TbCekqtyRossetController::class, 'storeJahit'])
        ->name('jahit.storeJahit');
    Route::post('perbaikan/storePerbaikan/{bagian}', [TbCekqtyRossetController::class, 'storePerbaikan'])
        ->name('perbaikan.storePerbaikan');
    
});


// Boleh multi-role
Route::middleware(['auth', 'role:user,monitoring'])->group(function () {
    Route::get('/shared', function () {
        return 'Shared Area';
    });
});

require __DIR__ . '/auth.php';
