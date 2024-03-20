<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\uploadExcelController;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
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

Route::get('/', [authController::class,'index'])->name('login');
Route::post('storeLogin',[authController::class,'store_login'])->name('storeLogin');
Route::get('logout',[authController::class,'logout'])->name('logout');


Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
});

Route::prefix('uploaData')->group(function () {
    Route::get('/', [uploadExcelController::class,'index'])->name('uploadData.index');
    Route::post('store', [uploadExcelController::class, 'store_file'])->name('store_file');
    Route::delete('deleteAll', [uploadExcelController::class, 'delete_all'])->name('delete_all');
    Route::post('storeMin', [uploadExcelController::class, 'store_min'])->name('store_min');
    Route::get('export', [uploadExcelController::class, 'store_export'])->name('store_export');
});

Route::prefix('listUser')->middleware('isAdmin','auth')  ->group(function(){
    Route::get('/',[userController::class,'index'])->name('listUser.index');
    Route::post('storeUser',[userController::class,'store_user'])->name('listUser.storeUser');
}); 
