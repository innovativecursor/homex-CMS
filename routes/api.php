<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\RateLimiter;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('aboutpage',[ApiController::class,'aboutpage']);
Route::get('getachivements',[ApiController::class,'getachivements']);

Route::get('gettestimonials',[ApiController::class,'gettestimonials']);
Route::get('getproject',[ApiController::class,'getproject']);
Route::get('getservice',[ApiController::class,'getservice']);
Route::get('getteam',[ApiController::class,'getteam']);
Route::post('projectdetails',[ApiController::class,'projectdetails']);



RateLimiter::for('storecontact', function (Request $request) {
    // Define the limit: 11 requests per minute
    return RateLimiter::perMinute(11);
});
Route::post('storecontact',[ApiController::class,'storecontact']);
