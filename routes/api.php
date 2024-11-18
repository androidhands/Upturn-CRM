<?php

use Database\Seeders\tenants\CountriesSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['api', 'checkPassword']], function () {

    Route::post('/tenantsmigrate', function () {
        Artisan::call('tenants:migrate');
        // Artisan::call('rollback-tenants');
    });

    Route::get('/clear-cache', function () {

        Artisan::call('optimize');
        // return what you want
    });

    Route::post('/systemmigrate', function () {

        Artisan::call('system:migrate');
    });



    Route::post('/SeedCountries', function () {

        Artisan::call('tenants:seeder', ['class' => CountriesSeeder::class]);
    });
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
