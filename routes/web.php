<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'guest'], function() {

    Route::get('/', [GuestController::class, 'index']);
    //REGISTER
    Route::get('/register', [GuestController::class, 'registerView']);
    Route::post('/register', [GuestController::class, 'register']);
    //LOGIN
    Route::get('/login', [GuestController::class, 'loginView'])->name('login');
    Route::post('/login', [GuestController::class, 'login']);
}); 

Route::group(['middleware' => 'auth'], function() {
    //HOME AND LOG APPROVAL
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/home/filter', [DashboardController::class, 'filter'])->name('filter.home');
    //LOGOUT
    Route::get('/logout', [GuestController::class, 'logout']);

    //USER MANAGEMENT
    Route::get('/users', [DashboardController::class, 'users'])->name('users.index');
    Route::get('/users/{id}/edit', [DashboardController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [DashboardController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [DashboardController::class, 'destroy'])->name('users.destroy');
    // Route::get('/users/create', [DashboardController::class, 'create'])->name('users.create');
    // Route::post('/users', [DashboardController::class, 'store'])->name('users.store');

    //SELF-LOG MANAGEMENT
    Route::get('/mylog', [LogController::class, 'index'])->name('log.index');
    Route::get('/mylog/filter', [LogController::class, 'filter'])->name('filter.logs');

    Route::get('/mylog/create', [LogController::class, 'create'])->name('log.create');
    Route::post('/mylog', [LogController::class, 'store'])->name('log.store');
    Route::delete('/mylog/{id}', [LogController::class, 'destroy'])->name('log.destroy');
    Route::get('/mylog/{id}/edit', [LogController::class, 'edit'])->name('log.edit');
    Route::put('/mylog/{id}', [LogController::class, 'update'])->name('log.update');
});
