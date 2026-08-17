<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BranchController;

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEnrollmentController;

Route::get('/', function () {
    return view('welcome');
});


    Route::get('/addmission', [AdmissionController::class, 'admission'])->name('admission');
    Route::get('/dashboard', [DashboardController::class,  'index' ])->name('dashboard');
    Route::get('/students/{student}/id-card',  [StudentController::class, 'idCard'])->name('admin.students.id-card');





// admin 
Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('branches', BranchController::class);
        Route::resource('students', StudentController::class );
  

    Route::prefix('academic')->name('academic.')->group(function () {
        Route::resource('sessions', AcademicSessionController::class);
        Route::resource('classes', SchoolClassController::class );
        Route::resource('sections', SectionController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource(  'class-subjects', ClassSubjectController::class);

    });

    Route::prefix('students/enrollments')->name('students.enrollments.')->group(function () {

        Route::get( '/',  [StudentEnrollmentController::class, 'index'])->name('index');
        Route::get( '/create',   [StudentEnrollmentController::class, 'create'])->name('create');
        Route::post( '/', [StudentEnrollmentController::class, 'store'] )->name('store');
        Route::get( '/{enrollment}',  [StudentEnrollmentController::class, 'show'] )->name('show');
        Route::get( '/{enrollment}/edit', [StudentEnrollmentController::class, 'edit'])->name('edit');
        Route::put( '/{enrollment}', [StudentEnrollmentController::class, 'update'])->name('update');
        Route::delete( '/{enrollment}',   [StudentEnrollmentController::class, 'destroy'] )->name('destroy');
    });

}); 


/*
|--------------------------------------------------------------------------
| Student Enrollment
|--------------------------------------------------------------------------
*/

