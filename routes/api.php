<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/tasks', [DataController::class, 'request'])->name('request');
Route::get('/tasks/{id}', [DataController::class, 'info'])->name('info');
Route::get('/files/{path}', [DataController::class, 'download'])->name('download')->where('path', '.*');
