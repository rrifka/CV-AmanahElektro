<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alatController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\pelanggandataController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\penyewaanController;
use App\Http\Controllers\penyewaandetailController;
use App\Http\Controllers\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/alat', alatController::class);
Route::apiResource('/pelanggan', pelangganController::class);
Route::apiResource('/pelanggandata', pelanggandataController::class);
Route::apiResource('/kategori', kategoriController::class);
Route::apiResource('/admin', adminController::class);
Route::apiResource('/penyewaan', penyewaanController::class);
Route::apiResource('/penyewaandetail', penyewaandetailController::class);
Route::post('/register', RegisterController::class);