<?php

namespace App\Providers;

use App\Repositories\FeeRepository;
use App\Repositories\QuizRepository;
use App\Repositories\RefundRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ReceiptRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\BaseRepositoryInterface;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Quizzes\QuizController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Finances\Billing\FeeController;
use App\Http\Controllers\Finances\Billing\RefundController;
use App\Http\Controllers\Finances\Billing\InvoiceController;
use App\Http\Controllers\Finances\Billing\ReceiptController;
use App\Http\Controllers\LibraryResourceController;
use App\Repositories\AttendanceRepository;
use App\Repositories\LibraryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    
    public function register()
    {
       $this->app->bind('App\Interfaces\TeacherRepositoryInterface',
                        'App\Repositories\TeacherRepository');
                        
       $this->app->bind('App\Interfaces\StudentRepositoryInterface',
                        'App\Repositories\StudentRepository');

       $this->app->bind('App\Interfaces\StudentPromotionRepositoryInterface',
                        'App\Repositories\StudentPromotionRepository');
                        
       $this->app->bind('App\Interfaces\GraduationRepositoryInterface',
                        'App\Repositories\GraduationRepository');


        $this->app->when(FeeController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(FeeRepository::class);

        $this->app->when(QuizController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(QuizRepository::class);

        $this->app->when(SubjectController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(SubjectRepository::class);

        $this->app->when(InvoiceController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(InvoiceRepository::class);

        
        $this->app->when(ReceiptController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(ReceiptRepository::class);
        
        $this->app->when(RefundController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(RefundRepository::class);
        
        $this->app->when(AttendanceController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(AttendanceRepository::class);
        
        $this->app->when(LibraryResourceController::class)
        ->needs(BaseRepositoryInterface::class)
        ->give(LibraryRepository::class);

    }

    
    public function boot()
    {
        //
    }
}