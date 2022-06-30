<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PesananController;


//posts

Route::get('/menu/showtype',[MenuController::class, 'showtype']);
Route::apiResource('/menu', MenuController::class);

Route::apiResource('/pesanan', PesananController::class);