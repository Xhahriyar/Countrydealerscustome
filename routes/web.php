<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('admin/dashboard');
});

// remove register route and redirect it to login page
Auth::routes(['register' => false]);

Route::get('/register', function () {
    return redirect('/login');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
