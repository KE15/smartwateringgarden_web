<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function(){
    return view('login');
});
Route::post('login', [App\Http\Controllers\UserController::class, 'loginAuth'])->name('loginAuth');
Route::post('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/', function (){
    return view('index');
})->name('index');

Route::get('/report', function () {
    return view('report', [
        "title" => "Report" 
    ]);
})->name('report');

Route::get('datasToday', [App\Http\Controllers\HomeController::class, 'DatasToday'])-> name('datasToday');
Route::post('renderChartHome', [App\Http\Controllers\HomeController::class, 'renderChartHome'])->name('renderChartHome');
Route::get('detailLogSiram', [App\Http\Controllers\HomeController::class, 'DetailLogSiram'])->name('detailLogSiram');

Route::get('ReportByDate', [App\Http\Controllers\ReportController::class, 'ReportByDate'])->name('ReportByDate');
Route::post('delete-data', [App\Http\Controllers\ReportController::class, 'DeleteData'])->name('DeleteData');
Route::delete('deleteDataByDate', [App\Http\Controllers\ReportController::class, 'DeleteDataByDate'])->name('DeleteDataByDate');

Route::get('profil', function(){
    return view('profil');
});

Route::get('callProfil', [App\Http\Controllers\UserController::class, 'callProfil'])-> name('callProfil');

Route::post('updateDevice', [App\Http\Controllers\DeviceControlller::class, 'UpdateDevice'])-> name('updateDevice');

Route::get('register', function(){
    return view('register');
});

Route::post('register', [App\Http\Controllers\UserController::class, 'registerAcc'])->name('registerAcc');
