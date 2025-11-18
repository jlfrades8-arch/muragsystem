<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdminAdoptionController;
use App\Http\Controllers\AdminRescueController;
use App\Http\Controllers\FeedbackController;

// Welcome page
Route::get('/', function () {
  return view('welcome');
})->name('welcome');

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Password reset routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token?}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Registration selection and forms
Route::get('/register', [AuthController::class, 'showRegisterSelect'])->name('register');
Route::get('/register/user', [AuthController::class, 'showRegisterUser'])->name('register.user');
Route::get('/register/admin', [AuthController::class, 'showRegisterAdmin'])->name('register.admin');

Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user.submit');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin.submit');

// Dashboard and logout
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
Route::get('/user/dashboard', [AuthController::class, 'showDashboard'])->name('user.dashboard');
// Dashboard verification (one-time code after sensitive actions)
Route::get('/dashboard/verify-code', [AuthController::class, 'showDashboardVerify'])->name('dashboard.verify');
Route::post('/dashboard/verify-code', [AuthController::class, 'postDashboardVerify'])->name('dashboard.verify.post');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/upload-picture', [AuthController::class, 'uploadProfilePicture'])->name('profile.upload');
Route::delete('/profile/delete-picture', [AuthController::class, 'deleteProfilePicture'])->name('profile.delete-picture');
// Allow both GET and POST for logout so views that POST (with CSRF) work and GET links still function.
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Rescue routes
Route::get('/rescue', [RescueController::class, 'form'])->name('rescue.form');
Route::post('/rescue', [RescueController::class, 'submitForm'])->name('rescue.submit');
Route::get('/rescue/confirmation', [RescueController::class, 'confirmation'])->name('rescue.confirmation');
Route::get('/rescue/list', [RescueController::class, 'list'])->name('rescue.list');
Route::post('/rescue/mark-rescued/{id}', [RescueController::class, 'markRescued'])->name('rescue.markRescued');


// Adoption routes integrated into dashboard
Route::get('/adoption', [AdoptionController::class, 'index'])->name('adoption.list'); // Pet list
Route::get('/adoption/form/{id}', [AdoptionController::class, 'form'])->name('adoption.form'); // Adoption form (detail)
Route::post('/adoption/submit', [AdoptionController::class, 'submit'])->name('adoption.submit'); // Submit adoption
Route::get('/my-adoptions', [AdoptionController::class, 'myAdoptions'])->name('my.adoptions');

// Admin adoption view (admin-specific)
Route::get('/admin/adoption', [AdminAdoptionController::class, 'index'])->name('admin.adoption');
// Cancel pending adoption(s) for a rescue (admin)
Route::post('/admin/adoption/{id}/cancel', [AdminAdoptionController::class, 'cancel'])->name('admin.adoption.cancel');

// Admin rescue reports
Route::get('/admin/rescue-reports', [AdminRescueController::class, 'index'])->name('admin.rescue.reports');
Route::get('/admin/rescue/{id}', [AdminRescueController::class, 'show'])->name('rescue.show');
Route::post('/admin/rescue/{id}/status', [AdminRescueController::class, 'updateStatus'])->name('rescue.updateStatus');
Route::post('/admin/rescue/{id}/upload-image', [AdminRescueController::class, 'uploadImage'])->name('rescue.uploadImage');
Route::post('/admin/rescue/{id}/update-name', [AdminRescueController::class, 'updateName'])->name('rescue.updateName');
Route::post('/admin/rescue/{id}/update-pet-name', [AdminRescueController::class, 'updatePetName'])->name('rescue.updatePetName');

// Admin settings
Route::get('/admin/settings', [AuthController::class, 'showAdminSettings'])->name('admin.settings');
Route::post('/admin/settings', [AuthController::class, 'updateAdminSettings'])->name('admin.settings.update');

// Admin users
Route::get('/admin/users', [AuthController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/users/{id}', [AuthController::class, 'showUserProfile'])->name('admin.user.profile');
Route::delete('/admin/users/{id}', [AuthController::class, 'destroyUser'])->name('admin.user.destroy');

// Feedback routes (public + admin)
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
// Community feedbacks - all users can see all feedbacks
Route::get('/feedbacks', [FeedbackController::class, 'userIndex'])->name('feedback.index');
// My feedbacks - list feedbacks submitted by the current logged-in user only
Route::get('/my-feedbacks', [FeedbackController::class, 'myFeedbacks'])->name('feedback.my');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/admin/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks');
Route::get('/admin/feedbacks/{id}', [FeedbackController::class, 'show'])->name('admin.feedbacks.show');
Route::post('/admin/feedbacks/{id}/reply', [FeedbackController::class, 'storeReply'])->name('admin.feedbacks.reply');
Route::post('/admin/feedbacks/{id}/close', [FeedbackController::class, 'close'])->name('admin.feedbacks.close');
Route::delete('/admin/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy');
