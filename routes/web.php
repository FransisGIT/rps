<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\RPSController;

Route::get('/', function () {
    return redirect()->route('mata-kuliah.index');
});

Route::resource('mata-kuliah', MataKuliahController::class);
Route::resource('rps', RPSController::class);
Route::get('rps/{id}/generate-qr', [RPSController::class, 'generateQRCode'])->name('rps.generate-qr');
Route::get('rps/{id}/pdf', [RPSController::class, 'exportPDF'])->name('rps.pdf');
Route::get('verify-qr', [RPSController::class, 'verifyQRCode'])->name('rps.verify');
Route::post('verify-qr', [RPSController::class, 'verifyQRCode']);
