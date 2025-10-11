<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\AdoptionController;

// Login routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');

// Registration selection and forms
Route::get('/register', [AuthController::class, 'showRegisterSelect'])->name('register.select');
Route::get('/register/user', [AuthController::class, 'showRegisterUser'])->name('register.user');
Route::get('/register/admin', [AuthController::class, 'showRegisterAdmin'])->name('register.admin');

Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user.submit');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin.submit');

// Dashboard and logout
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rescue routes
Route::get('/rescue', [RescueController::class, 'showForm'])->name('rescue.form');
Route::post('/rescue', [RescueController::class, 'submitForm'])->name('rescue.submit');
Route::get('/rescue/confirmation', [RescueController::class, 'confirmation'])->name('rescue.confirmation');
Route::get('/rescue/list', [RescueController::class, 'list'])->name('rescue.list');

// Adoption routes integrated into dashboard
Route::get('/adoption', [AdoptionController::class, 'index'])->name('adoption'); // Pet list
Route::get('/adoption/form/{id}', [AdoptionController::class, 'form'])->name('adoption.form'); // Adoption form
Route::post('/adoption/submit', [AdoptionController::class, 'submit'])->name('adoption.submit'); // Submit adoption
