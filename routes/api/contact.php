<?php

use App\Http\Controllers\Api\V1\ContactController as ApiContactController;
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

Route::prefix('/agenda/{idPhoneBook}')->as('contact.')->group(function () {
    Route::get('/listar-contatos', [ApiContactController::class, 'index'])->name('index');
    Route::post('/store', [ApiContactController::class, 'store'])->name('store');
    Route::put('/update/{contact}', [ApiContactController::class, 'update'])->name('update');
    Route::delete('/delete/{contact}', [ApiContactController::class, 'destroy'])->name('destroy');
});
