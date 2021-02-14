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
    ['prefix' => '{locale}', 'where' => ['locale' => join("|", \App\Models\Language::pluck("code")->all())], 'middleware' => 'setlocale',],
    function () {
        Route::get("/", function () {
            return view('home');
        })->name('home');

        Route::name('auth.')->group(function () {
            Route::get('login', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'loginPage'])->name('login');
            Route::post('login', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'login'])->name('login');
            Route::post('logout', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'logout'])->name('logout');
            Route::get('register', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'registerPage'])->name('register');
            Route::post('register', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'register'])->name('register');
        });

        Route::get('truck-operator', [\App\Http\Controllers\Frontend\Page\TruckOperatorController::class, 'index'])->name('truck-operator');
        Route::get('blog', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'index'])->name('blog');
        Route::get('single-blog', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'singlePage'])->name('single-blog');
        Route::get('contact-us', [\App\Http\Controllers\Frontend\Page\ContactUsPageController::class, 'index'])->name('contact-us');
        Route::get('privacy-and-policy', [\App\Http\Controllers\Frontend\Page\PageController::class, 'privacyAndPolicy'])->name('privacy-and-policy');
        Route::get('terms-and-condition', [\App\Http\Controllers\Frontend\Page\PageController::class, 'termsAndCondition'])->name('terms-and-condition');
        Route::get('faq', [\App\Http\Controllers\Frontend\Page\PageController::class, 'faq'])->name('faq');


        Route::group(["as" => "customer.", "prefix" => "customer", "middleware" => ["auth", "role:customer"]], function () {
            Route::get("dashboard", [\App\Http\Controllers\Frontend\User\DashboardController::class, "index"])->name('dashboard');
        });
    }
);

Route::group(
    ["prefix" => "admin", "as" => "admin."],
    function () {

        Route::get('login',  [\App\Http\Controllers\backend\AuthController::class, 'loginPage'])->name('login');
        Route::post('login',  [\App\Http\Controllers\backend\AuthController::class, 'login'])->name('login');

        Route::group(["middleware" => ["auth", "role:admin"]], function () {

            Route::post('logout',  [\App\Http\Controllers\backend\AuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [\App\Http\Controllers\backend\DashboardController::class, 'index'])->name('dashboard');

            Route::group(['prefix' => 'truck-size-category', 'as' => 'truck-size-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckSizeCategory}', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckSizeCategory}', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckSizeCategory}', [\App\Http\Controllers\backend\TruckSizeCategoryController::class, 'destroy'])->name('destroy');
            });


            Route::group(['prefix' => 'truck-weight-category', 'as' => 'truck-weight-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckWeightCategory}', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckWeightCategory}', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckWeightCategory}', [\App\Http\Controllers\backend\TruckWeightCategoryController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\LanguageController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\LanguageController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\LanguageController::class, 'store'])->name('store');
                Route::get('/edit/{language}', [\App\Http\Controllers\backend\LanguageController::class, 'edit'])->name('edit');
                Route::put('/{language}', [\App\Http\Controllers\backend\LanguageController::class, 'update'])->name('update');
                Route::delete('/{language}', [\App\Http\Controllers\backend\LanguageController::class, 'destroy'])->name('destroy');
            });


            Route::group(['prefix' => 'truck-covered-category', 'as' => 'truck-covered-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckCoveredCategory}', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckCoveredCategory}', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckCoveredCategory}', [\App\Http\Controllers\backend\TruckCoveredCategoryController::class, 'destroy'])->name('destroy');
            });


            Route::group(['prefix' => 'truck-brand-category', 'as' => 'truck-brand-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckBrandCategory}', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckBrandCategory}', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckBrandCategory}', [\App\Http\Controllers\backend\TruckBrandCategoryController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'truck-model-category', 'as' => 'truck-model-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckModelCategory}', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckModelCategory}', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckModelCategory}', [\App\Http\Controllers\backend\TruckModelCategoryController::class, 'destroy'])->name('destroy');
            });
        });
    }
);


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');