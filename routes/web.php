<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\uploadExcelController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('/', []);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [uploadExcelController::class, 'index'])->name('index');
    Route::post('store', [uploadExcelController::class, 'store_file'])->name('store_file');
    Route::delete('deleteAll', [uploadExcelController::class, 'delete_all'])->name('delete_all');
    Route::post('storeMin', [uploadExcelController::class, 'store_min'])->name('store_min');
    Route::get('export', [uploadExcelController::class, 'store_export'])->name('store_export');
});
