<?php

use App\Http\Controllers\DashboardUserController;
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
    return view('index');
})->name('index');

Route::get('/dashboard', [DashboardUserController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/desactive/{id}', [DashboardUserController::class, 'desactive'])->name('desactive_active_user');

Route::get('/dashboard/delete/{id}', [DashboardUserController::class, 'delete'])->name('user.delete');

Route::post('/dashboard/search', [DashboardUserController::class, 'search'])->name('user.search');

Route::post('/dashboard/filter', [DashboardUserController::class, 'filterBy'])->name('user.filter');


require __DIR__ . '/auth.php';
