<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
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
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    //LOGOUT
    Route::get('/logout', [GuestController::class, 'logout']);
    //USERS
    Route::get('/users', [DashboardController::class, 'users']);

    //USER EDIT
    Route::get('/users/{id}/edit', [DashboardController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [DashboardController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [DashboardController::class, 'destroy'])->name('users.destroy');
});
