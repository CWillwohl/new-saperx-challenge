<?php

use App\Http\Controllers\Api\V1\PhoneBookController as ApiPhoneBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/lista-telefonica')->as('phoneBook.')->group(function () {
    Route::get('/', [ApiPhoneBookController::class, 'index'])->name('index');
    Route::post('/store', [ApiPhoneBookController::class, 'store'])->name('store');
    Route::put('/update/{id}', [ApiPhoneBookController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ApiPhoneBookController::class, 'destroy'])->name('destroy');
});
