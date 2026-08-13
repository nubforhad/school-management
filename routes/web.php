<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/addmission', [AdmissionController::class, 'admission'])->name('admission');