<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventAdminController;

Route::prefix('admin')->group(function () {
    Route::get('/events', [EventAdminController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [EventAdminController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventAdminController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{id}/edit', [EventAdminController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{id}', [EventAdminController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{id}', [EventAdminController::class, 'destroy'])->name('admin.events.destroy');

    // ✅ Categorized events route
    Route::get('/events/categorized', [EventAdminController::class, 'categorized'])->name('admin.events.categorized');
});
