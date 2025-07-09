<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientPrescriptionStoreController;
use App\Http\Controllers\PayInstallmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\SaleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/clients', ClientController::class);
    Route::post('/clients/{client}/prescriptions', ClientPrescriptionStoreController::class)
        ->name('clients.prescriptions.store');

    Route::delete('/prescriptions/{id}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');

    Route::resource('/sales', SaleController::class)
        ->except(['edit', 'update', 'create']);

    Route::put('/installments/{installment}/pay', PayInstallmentController::class)->name('installments.pay');
});
