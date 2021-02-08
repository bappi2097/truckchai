<?php

use App\Http\Controllers\Admin\DashboardController;
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
    return view('admin.auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(
    [
       "prefix"  => "admin",
       "name" => ".admin",
       "namespace" => "App\Http\Controllers",
    ], function () {
        // Route::get('login', [Auth\LoginController:: ])
        Route::group(["middleware" => ["auth", "role:admin"]], function(){
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
});
