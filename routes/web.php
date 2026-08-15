<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BranchController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/addmission', [AdmissionController::class, 'admission'])->name('admission');









// admin 
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('branches', BranchController::class);
    });