<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('/{client}', [ClientController::class, 'update'])->name('update');
        Route::get('/{client}/delete', [ClientController::class, 'delete'])->name('delete');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
    });

    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');
});