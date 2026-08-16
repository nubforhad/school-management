<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BranchController;

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/addmission', [AdmissionController::class, 'admission'])->name('admission');









// admin 
Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('branches', BranchController::class);
  

    Route::prefix('academic')->name('academic.')->group(function () {
        Route::resource('sessions', AcademicSessionController::class);
        Route::resource('classes', SchoolClassController::class );
        Route::resource('sections', SectionController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource(  'class-subjects', ClassSubjectController::class);

    });
});