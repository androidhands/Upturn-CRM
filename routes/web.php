<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified','role:client'])->name('dashboard');



Route::middleware(['auth', 'verified', 'role:admin'])->group(function(){
    Route::get('/admin_dashboard', function () {
        return Inertia::render('AdminDashboard');
    })->name('admin_dashboard');
    Route::resource('country',CountryController::class);
    Route::resource('company',CompanyController::class);
     // Nested user routes under company
    Route::prefix('company/{company}')->group(function () {
        Route::resource('user', UserController::class);
    });
   


});
// client profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// admin profile
Route::middleware('auth')->group(function () {
    Route::get('/admin_profile', [AdminProfileController::class, 'edit'])->name('admin_profile.edit');
    Route::patch('/admin_profile', [AdminProfileController::class, 'update'])->name('admin_profile.update');
    Route::delete('/admin_profile', [AdminProfileController::class, 'destroy'])->name('admin_profile.destroy');
});




require __DIR__.'/auth.php';
