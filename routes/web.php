<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\ActivityApiController;
use App\Http\Controllers\Api\StatsApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route des auth
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route des activités
    Route::get('/activite', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('/activite', [ActivityController::class, 'store'])->name('activities.store');

    //Route des classements
    Route::get('/classements', [RankingController::class, 'index'])->name('rankings.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->names('users');
    Route::get('/export/csv', [ExportController::class, 'csv'])->name('export.csv');
});

// Statistiques
Route::get('/api/stats/general', [StatsApiController::class, 'general']);
Route::get('/api/stats/teams', [StatsApiController::class, 'teams']);
Route::get('/api/stats/users', [StatsApiController::class, 'users']);

// Activités
Route::get('/api/activities', [ActivityApiController::class, 'index']);
Route::get('/api/activities/user/{id}', [ActivityApiController::class, 'byUser']);


require __DIR__ . '/auth.php';
