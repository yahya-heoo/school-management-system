<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Finances\Billing\FeeController;
use App\Http\Controllers\Finances\Billing\InvoiceController;
use App\Http\Controllers\Finances\Billing\ReceiptController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Finances\Billing\RefundController;
use App\Http\Controllers\LibraryResourceController;
use App\Http\Controllers\OnlineClassesController;
use App\Http\Controllers\Quizzes\QuizController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Students\GraduationController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'guest']
    ],function () {
    Route::get('/', function () {
         return view('auth.login');
         
    });
    Route::get('/ss', function () {
        return view('auth.selection');
    });
    Route::get('register', function () {
        return view('auth.register');
    });
    
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']
    ],
    function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        //Parents Routes 
        Route::view('add_parent', 'livewire.show_form')->name('add_parent');
        Route::get('/edit_parent/{id}', function ($id) {
            return view('livewire.show_form', [
                'editMode' => true,
                'parent_id' => $id
            ]);
        })->name('edit_parent');

        Route::resource('grades', GradeController::class);
        Route::resource('fees', FeeController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('library-resources',  LibraryResourceController::class);
        Route::resource('online-classes', OnlineClassesController::class);
        Route::resource('attendances', AttendanceController::class);
        Route::resource('refunds', RefundController::class);
        Route::resource('receipts', ReceiptController::class);
        Route::resource('quizzes', QuizController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('students', StudentController::class);
        Route::resource('graduations', GraduationController::class);
        Route::resource('sections', SectionController::class);
        Route::resource('classrooms', ClassroomController::class);
        Route::resource('promotions', PromotionController::class);
        Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');

        Route::post('filter_Classes', [ClassroomController::class, 'filter_Classes'])->name('filter_Classes');
        Route::get('filter_Classes', [ClassroomController::class, 'filter_Classes'])->name('filter_Classes');


        Route::get('classes/{id}', [SectionController::class, 'getClasses']);
        Route::get('getStudentClasses/{id}', [StudentController::class, 'getClasses']);
        Route::get('getAmounts/{id}', [InvoiceController::class, 'getAmounts'])->name('getAmounts');
        Route::get('getStudentSections/{id}', [StudentController::class, 'getSections']);
        Route::post('upload_attachments', [StudentController::class, 'upload_attachments'])->name('upload_attachments');
        Route::get('download_attachments/{attachmentID}', [StudentController::class, 'download_attachments'])->name('download_attachments');
        Route::get('library-resources/download_resource/{resourceID}', [LibraryResourceController::class, 'download'])->name('download_resource');
        Route::post('delete_attachments', [StudentController::class, 'delete_attachments'])->name('delete_attachments');
        Route::post('existing-zoom', [OnlineClassesController::class, 'storeExistingZoom'])->name('online-classes.store-existing-zoom');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/test-zoom-auth', [App\Http\Controllers\OnlineClassesController::class, 'testZoomAuth']);
    }
);






require __DIR__ . '/auth.php';