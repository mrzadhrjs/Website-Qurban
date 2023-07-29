<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardGradeController;
use App\Http\Controllers\DashboardHewanController;
use App\Http\Controllers\AlamatCheckController;
use App\Http\Controllers\DashboardHewanGradeController;
use App\Http\Controllers\DashboardHewanBobotController;

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

Route::get('/', [HewanController::class, 'index']);
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('admin');
Route::get('/aboutus', [HewanController::class, 'aboutus']);
;Route::post('/keranjang', [KeranjangController::class, 'store']);
Route::get('/bayar', [HewanController::class, 'bayar'])->middleware('usercheck');
Route::post('/bayar', [TransaksiController::class, 'store']);
Route::post('/login', [LoginController::class, 'authentication']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);
Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy']);
Route::resource('/dashboard/user', DashboardUserController::class)->middleware('admin');
Route::resource('/dashboard/grade', DashboardGradeController::class)->middleware('admin');
Route::resource('/dashboard/hewan', DashboardHewanController::class)->middleware('admin');
Route::resource('/dashboard/hewan/grade', DashboardHewanGradeController::class)->middleware('admin');
Route::resource('/dashboard/hewan/bobot', DashboardHewanBobotController::class)->middleware('admin');
Route::get('/{hewan:nama}', [HewanController::class, 'show']);

