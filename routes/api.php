<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [DataController::class, 'request'])->name('request');
Route::get('/tasks/{id}', [DataController::class, 'info'])->name('info');
Route::get('/files/{path}', [DataController::class, 'download'])
    ->name('download')
    ->where('path', '.*');
