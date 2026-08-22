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
use App\Http\Controllers\AttendanceController;

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
}); 

//Student Enrollment 
 
Route::prefix('admin')->name('admin.')->group(function () { 
        // Enrollment History
        Route::get( 'students/{student}/enrollments', [StudentEnrollmentController::class, 'index'] )->name('students.enrollments.index');
        // Create / Promote
        Route::get( 'students/{student}/enrollments/create', [StudentEnrollmentController::class, 'create'])->name('students.enrollments.create');
        // Store
        Route::post( 'students/{student}/enrollments', [StudentEnrollmentController::class, 'store'])->name('students.enrollments.store');
        // View
        Route::get('students/{student}/enrollments/{enrollment}',  [StudentEnrollmentController::class, 'show'])->name('students.enrollments.show');
        // Edit
        Route::get('students/{student}/enrollments/{enrollment}/edit',  [StudentEnrollmentController::class, 'edit'])->name('students.enrollments.edit');
        // Update
        Route::put( 'students/{student}/enrollments/{enrollment}', [StudentEnrollmentController::class, 'update'])->name('students.enrollments.update');
        // Delete
        Route::delete( 'students/{student}/enrollments/{enrollment}', [StudentEnrollmentController::class, 'destroy'])->name('students.enrollments.destroy');
        //Dynamic Sections 
        Route::get(  'enrollments/sections',  [StudentEnrollmentController::class, 'sections'])->name('students.enrollments.sections');

        // bulk enrollment      
        Route::get( 'student-enrollments/bulk/create', [StudentEnrollmentController::class, 'bulkCreate'])->name('student-enrollments.bulk.create');
        Route::get( 'student-enrollments/bulk/students', [StudentEnrollmentController::class, 'bulkStudents'])->name('student-enrollments.bulk.students');
        Route::post( 'student-enrollments/bulk', [StudentEnrollmentController::class, 'bulkStore'])->name('student-enrollments.bulk.store');
        Route::get(  'student-enrollments/sections', [StudentEnrollmentController::class, 'sections'])->name('student-enrollments.sections');

        // attendance route 
        Route::prefix('attendance')->name('attendance.')->group(function () { 
            Route::get('/', [AttendanceController::class, 'index'])->name('index');
            Route::post('/store', [ AttendanceController::class, 'store'])->name('store');
        });
        Route::get(  'attendances/report', [AttendanceController::class, 'report'])->name('attendances.report');
        Route::get( 'attendance/analytics', [AttendanceController::class, 'analytics'])->name('attendance.analytics');
        Route::get( 'attendance/student-history', [AttendanceController::class, 'studentHistory'])->name('attendance.student-history');
        Route::get('attendance/{attendance}/edit',  [AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::put( 'attendance/{attendance}',  [AttendanceController::class, 'update'])->name('attendance.update');
        Route::get('attendance/monthly-report', [AttendanceController::class, 'monthlyReport'])->name('attendance.monthly-report');
        

});