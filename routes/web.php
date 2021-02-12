<?php

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

// auth()->login(App\Models\User::find(1));
// auth()->logout();
Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::group(
    [
        'prefix' => '{locale}',
        'where' => ['locale' => join("|", \App\Models\Language::pluck("code")->all())],
        'middleware' => 'setlocale',
    ],
    function () {
        Route::get("/", function () {
            return view('home');
        })->name('home');
        Route::get('truck-operator', [\App\Http\Controllers\Frontend\Page\TruckOperatorController::class, 'index'])->name('truck-operator');
        Route::get('blog', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'index'])->name('blog');
        Route::get('login', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'loginPage'])->name('login');
        Route::get('register', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'registerPage'])->name('register');
    }
);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(
    ["prefix" => "admin", "as" => "admin."],
    function () {
        // Route::get('login',  [\App\Http\Controllers\Admin\AuthController::class, 'loginPage'])->name('login');
        // Route::group(["middleware" => ["auth", "role:admin"]], function () {
        //     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // });
    }
);
Route::get('/test', function () {
    return view('frontend.layout.master');
});
