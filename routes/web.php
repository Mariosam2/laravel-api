<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Projects\ProjectController;
use App\Http\Controllers\Admin\Technologies\TechnologyController;
use App\Http\Controllers\Admin\Types\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/projects', ProjectController::class)->parameters([
        'projects' => 'project:slug',
    ]);
    Route::resource('/types', TypeController::class)->parameters([
        'types' => 'type:slug',
    ]);
    Route::resource('/technologies', TechnologyController::class)->parameters([
        'technologies' => 'technology:slug',
    ]);
});





require __DIR__ . '/auth.php';
