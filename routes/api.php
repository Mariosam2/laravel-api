<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
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


Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('api.project');
Route::post('/contacts', [ContactController::class, 'store'])->name('api.contacts');
