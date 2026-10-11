<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

// Pages for visitors who are not logged in
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Pages that need a logged-in user
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Sends each user to the home page for their role
    Route::get('/dashboard', function () {
        return redirect()->route(auth()->user()->homeRoute());
    })->name('dashboard');

    // Owner portal
    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function () {
        Route::get('/', [OwnerController::class, 'dashboard'])->name('dashboard');
        Route::get('/apartments/create', [OwnerController::class, 'createApartment'])->name('apartments.create');
    });

    // Client portal
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/apartments', [ClientController::class, 'search'])->name('search');
    });

    // Staff dashboard (all four staff roles)
    Route::middleware('role:admin,manager,specialist,receptionist')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [StaffController::class, 'dashboard'])->name('dashboard');
    });

    // System Administrator only
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
    });
});
