<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\authController;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/signUp', [authController::class, 'signUp']);

Route::get('/signIn', [authController::class, 'signIn']);

Route::post('/signUp/create', [authController::class, 'signUp_valid']);

Route::post('/signIn/auth', [authController::class, 'signIn_valid']);

Route::get('/logout', [authController::class, 'logout']);

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/add', [AdminController::class, 'view_add']);

Route::post('/admin/add/create', [AdminController::class, 'create_product']);

Route::get('/admin/edit/{edit}', [AdminController::class, 'view_edit']);

Route::get('/admin/delete/{delete}', [AdminController::class, 'delete']);

Route::post('/admin/edit/update/{product}', [AdminController::class, 'update_product']);
