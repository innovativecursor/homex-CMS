<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;






// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login-user', [AuthController::class, 'loginuser'])->name('loginuser');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin-dashbord');

    Route::get('user-list', [UserController::class, 'index'])->name('user-list')->middleware(RoleMiddleware::class);
    Route::get('admin-user-datable', [UserController::class, 'datable'])->name('admin-user-datable')->middleware(RoleMiddleware::class);
    Route::get('user-add', [UserController::class, 'create'])->name('user-add')->middleware(RoleMiddleware::class);
    Route::post('user-store', [UserController::class, 'store'])->name('user-store')->middleware(RoleMiddleware::class);
    Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit')->middleware(RoleMiddleware::class);
    Route::post('user-update/{id}', [UserController::class, 'update'])->name('user-update')->middleware(RoleMiddleware::class);
    Route::get('user-delete/{id}', [UserController::class, 'delete'])->name('user-delete')->middleware(RoleMiddleware::class);

    Route::get('testimonials-add', [TestimonialsController::class, 'create'])->name('testimonials-add');
    Route::post('testimonials-store', [TestimonialsController::class, 'store'])->name('testimonials-store');
    Route::get('testimonials-edit/{id}', [TestimonialsController::class, 'edit'])->name('testimonials-edit');
    Route::post('testimonials-update/{id}', [TestimonialsController::class, 'update'])->name('testimonials-update');
    Route::get('testimonials-delete/{id}', [TestimonialsController::class, 'delete'])->name('testimonials-delete');
    Route::get('admin-testimonials-datable', [TestimonialsController::class, 'datable'])->name('admin-testimonials-datable');
    Route::get('testimonials-list', [TestimonialsController::class, 'index'])->name('testimonials-list');


    Route::get('project-add', [ProjectController::class, 'create'])->name('project-add');
    Route::post('project-store', [ProjectController::class, 'store'])->name('project-store');
    Route::get('project-edit/{id}', [ProjectController::class, 'edit'])->name('project-edit');
    Route::post('project-update/{id}', [ProjectController::class, 'update'])->name('project-update');
    Route::get('project-delete/{id}', [ProjectController::class, 'delete'])->name('project-delete');
    Route::get('admin-project-datable', [ProjectController::class, 'datable'])->name('admin-project-datable');
    Route::get('project-list', [ProjectController::class, 'index'])->name('project-list');


    Route::get('contact-list', [ContactController::class, 'index'])->name('contact-list');
    Route::get('admin-contact-datable', [ContactController::class, 'datable'])->name('admin-contact-datable');
    Route::get('about', [AboutController::class, 'index'])->name('admin-about');
    Route::post('about-store', [AboutController::class, 'store'])->name('about-store');

    Route::get('service-add', [ServiceController::class, 'create'])->name('service-add');
    Route::post('service-store', [ServiceController::class, 'store'])->name('service-store');
    Route::get('service-edit/{id}', [ServiceController::class, 'edit'])->name('service-edit');
    Route::post('service-update/{id}', [ServiceController::class, 'update'])->name('service-update');
    Route::get('service-delete/{id}', [ServiceController::class, 'delete'])->name('service-delete');
    Route::get('admin-service-datable', [ServiceController::class, 'datable'])->name('admin-service-datable');
    Route::get('service-list', [ServiceController::class, 'index'])->name('service-list');


    Route::get('team-add', [TeamController::class, 'create'])->name('team-add');
    Route::post('team-store', [TeamController::class, 'store'])->name('team-store');
    Route::get('team-edit/{id}', [TeamController::class, 'edit'])->name('team-edit');
    Route::post('team-update/{id}', [TeamController::class, 'update'])->name('team-update');
    Route::get('team-delete/{id}', [TeamController::class, 'delete'])->name('team-delete');
    Route::get('admin-team-datable', [TeamController::class, 'datable'])->name('admin-team-datable');
    Route::get('team-list', [TeamController::class, 'index'])->name('team-list');


    Route::get('achievements', [AchievementsController::class, 'index'])->name('admin-achievements');
    Route::post('achievements-store', [AchievementsController::class, 'store'])->name('achievements-store');

    Route::get('change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password.form');
    Route::get('contact-delete/{id}', [ContactController::class, 'delete'])->name('contact-delete');


// Handle password change request
Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password.update');

});
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password.form');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendNewPassword'])->name('forgot-password.send');
