<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/', [DashboardController::class, 'home'])->middleware('auth');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::get('/spatie', [DashboardController::class, 'spatie'])->name('spatie');

    Route::prefix('/emas')->name('emas.')->group(function () {
        Route::get('', [EmasController::class, 'index'])->name('index');
        // Route::get('/get', [BukuController::class, 'getData'])->name('get-data');
        // Route::post('/', [BukuController::class, 'store'])->name('create');
        // Route::get('/edit', [BukuController::class, 'edit'])->name('edit');
        // Route::put('/', [BukuController::class, 'update'])->name('update');
        // Route::delete('/', [BukuController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/toko')->name('toko.')->group(function () {
        Route::get('', [TokoController::class, 'index'])->name('index');
        Route::get('/get', [TokoController::class, 'getData'])->name('get-data');
        Route::post('/', [TokoController::class, 'store'])->name('create');
        Route::get('/edit', [TokoController::class, 'edit'])->name('edit');
        Route::put('/', [TokoController::class, 'update'])->name('update');
        Route::delete('/', [TokoController::class, 'destroy'])->name('delete');
    });
});

require __DIR__.'/auth.php';
