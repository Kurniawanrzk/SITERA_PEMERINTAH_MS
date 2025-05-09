<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PemerintahController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1/pemerintah")->group(function() {
    Route::get("cek-user/{user_id}", [PemerintahController::class, "cekUser"]);

    Route::middleware("checkifpemerintah")->group(function(){
        Route::get("total-sampah-keseluruhan", [PemerintahController::class, "getTransaksiSeluruhBSU"]);
        Route::get("total-nasabah-keseluruhan", [PemerintahController::class, "getNasabahSeluruhBSU"]);
    });
});