<?php

// use App\Http\Controllers;
// use App\Http\Controllers\Admin\AuthController;

// use Illuminate\Http\Client\Request;

// use Illuminate\Http\Request;
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

// Route::get('/login', function () {
//     return redirect(app()->getLocale() . "/login");
// });



// Route::get('/register', function () {
//     return redirect(app()->getLocale() . "/register");
// });

// Route::get('/admin/login', function () {
//     return redirect(app()->getLocale() . "/admin-login");
// });
// dd(App\Models\Language::pluck("code")->all());
$languages = join("|", App\Models\Language::pluck("code")->all());
Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::group(
    [
        'prefix' => '{locale}',
        'where' => ['locale' => $languages],
        'middleware' => 'setlocale',
    ],
    function () {
        Route::get("/", function () {
            return view('home');
        });
    }
);

// Route::group(['prefix' => '/*'], function () {
//     // dd(app()->getlocale('en') . \Request::path());
//     return redirect(app()->getlocale() . \Request::path());
//     // return redirect(\Request::path());
//     // return redirect(app()->getLocale() . "/login");
// });
// Route::group(['prefix' => '{any}'], function () {
//     if (\Request::is('/')) {
//         return redirect(app()->getLocale());
//     }
//     return redirect(app()->getLocale());
// })->where('any', '.*');

// Route::group(['prefix' => '{locale}'], function () {
//     dd(true);
// });
// Route::get('/*', function () {
//     return redirect(app()->getLocale());
// });
// Route::get('/{locale}', function ($locale) {
//     if (App\Models\Language::where('code', $locale)->exists()) {
//         app()->setLocale($locale);
//     }
//     return view('home');
// });

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
