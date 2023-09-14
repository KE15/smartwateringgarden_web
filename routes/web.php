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



Route::get('/', function (){
    return view('index');
});

Route::get('/report', function () {
    return view('report', [
        "title" => "Report" 
    ]);
});

Route::get('datasToday', [App\Http\Controllers\HomeController::class, 'DatasToday'])-> name('datasToday');
Route::post('renderChartHome', [App\Http\Controllers\HomeController::class, 'renderChartHome'])->name('renderChartHome');
Route::get('detailLogSiram', [App\Http\Controllers\HomeController::class, 'DetailLogSiram'])->name('detailLogSiram');

Route::post('ReportByDate', [App\Http\Controllers\ReportController::class, 'ReportByDate'])->name('ReportByDate');