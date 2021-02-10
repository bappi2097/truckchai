<?php

// use App\Http\Controllers;
// use App\Http\Controllers\Admin\AuthController;
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
    ["prefix" => "admin", "as" => "admin."],
    function () {
        Route::get('login',  [\App\Http\Controllers\Admin\AuthController::class, 'loginPage'])->name('login');
        Route::group(["middleware" => ["auth", "role:admin"]], function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
    }
);
Route::get('/test', function () {
    return view('frontend.layout.master');
});
