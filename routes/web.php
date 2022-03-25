<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\DashboardUserController;

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

Route::get('/dashboard', [DashboardUserController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/desactive_user/{id}', [DashboardUserController::class, 'desactive'])->name('desactive_active_user');

Route::delete('/dashboard/delete_user/{id}', [DashboardUserController::class, 'delete'])->name('user.delete');

Route::post('/dashboard/search_user', [DashboardUserController::class, 'search'])->name('user.search');

Route::post('/dashboard/filter_user', [DashboardUserController::class, 'filterBy'])->name('user.filter');

Route::get('/dashboard/new_user', [DashboardUserController::class, 'new'])->name('user.new');

Route::post('/dashboard/user_store', [DashboardUserController::class, 'store'])->name('user.store');

Route::get('/dashboard/user_to_update/{id}', [DashboardUserController::class, 'to_update'])->name('user.to_update');

Route::post('/dashboard/update_user/{id}', [DashboardUserController::class, 'update'])->name('user.update');



// Routes pour la gestion des voitures 


Route::get('/dashboard/cars', [CarsController::class, 'cars'])->name('cars');

Route::post('/dashboard/search_car', [CarsController::class, 'search'])->name('car.search');

Route::get('/dashboard/delete_car/{immatriculation}', [CarsController::class, 'delete'])->name('car.delete');

Route::post('/dashboard/filter_car', [CarsController::class, 'filterBy'])->name('car.filter');

Route::post('/dashboard/car_store', [CarsController::class, 'store'])->name('car.store');

Route::get('/dashboard/car_to_update/{immatriculation}', [CarsController::class, 'to_update'])->name('car.to_update');

Route::post('/dashboard/update_car/{immatriculation}', [CarsController::class, 'update'])->name('car.update');

//Routes pour la gestion des chauffeurs

Route::get('/dashboard/drivers', [DriversController::class, 'drivers'])->name('drivers');

Route::post('/dashboard/search_driver', [DriversController::class, 'search'])->name('driver.search');

Route::get('/dashboard/delete_driver/{id}', [DriversController::class, 'delete'])->name('driver.delete');

Route::post('/dashboard/filter_driver', [DriversController::class, 'filterBy'])->name('driver.filter');

Route::get('/dashboard/driver_new', [DriversController::class, 'new'])->name('driver.new');

Route::post('/dashboard/driver_store', [DriversController::class, 'store'])->name('driver.store');

Route::get('/dashboard/driver_to_update/{id}', [DriversController::class, 'to_update'])->name('driver.to_update');

Route::post('/dashboard/update_driver/{id}', [DriversController::class, 'update'])->name('driver.update');

require __DIR__ . '/auth.php';
