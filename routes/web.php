<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
	return view('welcome');
});
Route::get('/report_daily_flight/{date}', [DataController::class, 'getDailyFlightData'])->name('report.daily-flight');