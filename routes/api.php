<?php

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);

Route::get('events-categorized', [EventController::class, 'categorized']);
