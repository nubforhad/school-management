<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEnrollmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\FeePaymentController; 
use App\Http\Controllers\FeeReportController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamScheduleController;

Route::get('/', function () {
    return view('welcome');
});


// ==============================
// Authentication
// ==============================

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});




Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/addmission', [AdmissionController::class, 'admission'])->name('admission');
    // Route::get('/dashboard', [DashboardController::class,  'index' ])->name('dashboard');
    Route::get('/students/{student}/id-card',  [StudentController::class, 'idCard'])->name('admin.students.id-card');

// admin 
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
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

      
        // fee type date 23 08 26 Forhad
        Route::resource('fee-types', FeeTypeController::class)->except(['show'])->names('fee-types');
        Route::patch('fee-types/{feeType}/toggle-status',  [FeeTypeController::class, 'toggleStatus'])->name('fee-types.toggle-status');
        // Student Fee Assignment
        Route::resource( 'student-fees',  StudentFeeController::class)->names('student-fees');
        // Fee Collection
        Route::prefix('fee-collection')->name('fee-collection.')->group(function () {
            Route::get( '/', [FeePaymentController::class, 'index'])->name('index');
            Route::get( '/{studentFeeAssignment}/create',  [FeePaymentController::class, 'create'])->name('create');
            Route::post( '/{studentFeeAssignment}',  [FeePaymentController::class, 'store'] )->name('store');
            // Payment receipt
            Route::get('/payment/{payment}/receipt', [ FeeCollectionController::class, 'receipt'])->name('receipt');

        });

        // Fee Payment History
    Route::get( 'fee-payment-history', [FeePaymentController::class, 'history'])->name('fee-payment-history.index');
    Route::get('fee-payment-history/{feePayment}', [FeePaymentController::class, 'show'])->name('fee-payment-history.show');
    Route::get('fee-payment-history/{feePayment}/receipt',  [FeePaymentController::class, 'receipt'])->name('fee-payment-history.receipt');    

    Route::get('/fee-reports/collection',  [FeeReportController::class, 'collection'])->name('fee-reports.collection');
    Route::get('fee-collection/report', [FeePaymentController::class, 'report'])->name('fee-collection.report');

    Route::get('/fee-collection/due-report', [FeePaymentController::class, 'dueReport'])->name('fee-collection.due-report');


    Route::resource('exams', ExamController::class);

     
 

});


    Route::prefix('exams/{exam}')->name('admin.exams.')->group(function () {
        Route::get( 'schedules',  [ExamScheduleController::class, 'index'])->name('schedules.index');
        Route::get('schedules/create',  [ExamScheduleController::class, 'create'])->name('schedules.create');
        Route::post( 'schedules',  [ExamScheduleController::class, 'store'])->name('schedules.store');
        Route::get('schedules/{schedule}/edit',   [ExamScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put(  'schedules/{schedule}',   [ExamScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('schedules/{schedule}',  [ExamScheduleController::class, 'destroy'])->name('schedules.destroy');
    });