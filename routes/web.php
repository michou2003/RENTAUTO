<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LocationsController;
use phpDocumentor\Reflection\Location;

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
    return view('index');
})->name('index');

Route::middleware(['auth'])->group(function () {

    Route::controller(DashboardUserController::class)->group(function () {

        Route::get('/dashboard', [DashboardUserController::class, 'dashboard'])->name('dashboard');

        Route::get('/dashboard/user/desactive_user/{id}', 'desactive')->name('desactive_active_user');

        Route::delete('/dashboard/user/delete_user/{id}', 'delete')->name('user.delete');

        Route::post('/dashboard/user/search_user', 'search')->name('user.search');

        Route::post('/dashboard/user/filter_user', 'filterBy')->name('user.filter');

        Route::get('/dashboard/user/new_user', 'new')->name('user.new');

        Route::post('/dashboard/user/user_store', 'store')->name('user.store');

        Route::get('/dashboard/user/user_to_update/{id}', 'to_update')->name('user.to_update');

        Route::post('/dashboard/user/update_user/{id}', 'update')->name('user.update');
    });

    Route::controller(CarsController::class)->group(function () {

        Route::get('/dashboard/cars',  'cars')->name('cars');

        Route::post('/dashboard/cars/search_car',  'search')->name('car.search');

        Route::get('/dashboard/cars/delete_car/{immatriculation}',  'delete')->name('car.delete');

        Route::post('/dashboard/cars/filter_car',  'filterBy')->name('car.filter');

        Route::post('/dashboard/cars/car_store',  'store')->name('car.store');

        Route::get('/dashboard/cars/car_to_update/{immatriculation}',  'to_update')->name('car.to_update');

        Route::post('/dashboard/cars/update_car/{immatriculation}',  'update')->name('car.update');
    });

    Route::controller(DriversController::class)->group(function () {

        Route::get('/dashboard/drivers', 'drivers')->name('drivers');

        Route::post('/dashboard/drivers/search_driver',  'search')->name('driver.search');

        Route::get('/dashboard/drivers/delete_driver/{id}',  'delete')->name('driver.delete');

        Route::post('/dashboard/drivers/filter_driver',  'filterBy')->name('driver.filter');

        Route::get('/dashboard/drivers/driver_new',  'new')->name('driver.new');

        Route::post('/dashboard/drivers/driver_store',  'store')->name('driver.store');

        Route::get('/dashboard/drivers/driver_to_update/{id}',  'to_update')->name('driver.to_update');

        Route::post('/dashboard/drivers/update_driver/{id}',  'update')->name('driver.update');
    });

    Route::controller(LocationsController::class)->group(function () {

        Route::get('/dashboard/locations', 'locations')->name('locations');

        Route::post('/dashboard/locations/search_location', 'search')->name('location.search');

        Route::post('/dashboard/locations/filter_location', 'filterBy')->name('location.filter');

        Route::get('/dashboard/locations/location_new', 'new')->name('location.new');

        Route::post('/dashboard/locations/location_store', 'store')->name('location.store');

        Route::get('/dashboard/locations/location_to_update/{id}',  'to_update')->name('location.to_update');

        Route::post('/dashboard/locations/update_location/{id}',  'update')->name('location.update');

        Route::get('/dashboard/locations/valider_paiement/{id}', 'validerPaiement')->name('location.valider_paiement');
    });
});


require __DIR__ . '/auth.php';
