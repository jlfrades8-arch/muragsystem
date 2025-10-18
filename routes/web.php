<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdminAdoptionController;
use App\Http\Controllers\AdminRescueController;

// Welcome page
Route::get('/', function () {
  return view('welcome');
})->name('welcome');

// Login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Registration selection and forms
Route::get('/register', [AuthController::class, 'showRegisterSelect'])->name('register');
Route::get('/register/user', [AuthController::class, 'showRegisterUser'])->name('register.user');
Route::get('/register/admin', [AuthController::class, 'showRegisterAdmin'])->name('register.admin');

Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user.submit');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin.submit');

// Dashboard and logout
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
Route::get('/user/dashboard', [AuthController::class, 'showDashboard'])->name('user.dashboard');
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

// Admin rescue reports
Route::get('/admin/rescue-reports', [AdminRescueController::class, 'index'])->name('admin.rescue.reports');
Route::get('/admin/rescue/{id}', [AdminRescueController::class, 'show'])->name('rescue.show');
Route::post('/admin/rescue/{id}/status', [AdminRescueController::class, 'updateStatus'])->name('rescue.updateStatus');
Route::post('/admin/rescue/{id}/upload-image', [AdminRescueController::class, 'uploadImage'])->name('rescue.uploadImage');
Route::post('/admin/rescue/{id}/update-name', [AdminRescueController::class, 'updateName'])->name('rescue.updateName');
Route::post('/admin/rescue/{id}/update-pet-name', [AdminRescueController::class, 'updatePetName'])->name('rescue.updatePetName');
