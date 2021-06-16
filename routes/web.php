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


Route::get('/', function () {
    return redirect(app()->getLocale());
});


Route::group(
    ['prefix' => '{locale}', 'where' => ['locale' => join("|", \App\Models\Language::pluck("code")->all())], 'middleware' => 'setlocale',],
    function () {

        Route::get("/", [\App\Http\Controllers\HomeController::class, "index"])->name('home');
        Route::get("/why-blogs", [\App\Http\Controllers\HomeController::class, "whyBlogs"])->name('why-blogs');
        Route::get("/latest-blogs", [\App\Http\Controllers\HomeController::class, "latestBlogs"])->name('latest-blogs');
        Route::get("/clients", [\App\Http\Controllers\HomeController::class, "clients"])->name('clients');


        Route::name('auth.')->group(function () {
            Route::get('login', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'loginPage'])->name('login');
            Route::post('login', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'login'])->name('login');
            Route::post('logout', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'logout'])->name('logout');
            Route::get('register', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'registerPage'])->name('register');
            Route::post('register', [\App\Http\Controllers\Frontend\Auth\AuthController::class, 'register'])->name('register');
        });

        Route::get('truck-operator', [\App\Http\Controllers\Frontend\Page\TruckOperatorController::class, 'index'])->name('truck-operator');
        Route::get('blog', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'index'])->name('blog');
        Route::get('single-blog/{slug}', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'singleBlog'])->name('single-blog');
        Route::get('category/{slug}', [\App\Http\Controllers\Frontend\Page\BlogPageController::class, 'blogCategory'])->name('blog-category');
        Route::get('contact-us', [\App\Http\Controllers\Frontend\Page\ContactUsPageController::class, 'index'])->name('contact-us');
        Route::post('contact-us', [\App\Http\Controllers\Frontend\Page\ContactUsPageController::class, 'store'])->name('contact-store');
        Route::get('privacy-and-policy', [\App\Http\Controllers\Frontend\Page\PageController::class, 'privacyAndPolicy'])->name('privacy-and-policy');
        Route::get('terms-and-condition', [\App\Http\Controllers\Frontend\Page\PageController::class, 'termsAndCondition'])->name('terms-and-condition');
        Route::get('faq', [\App\Http\Controllers\Frontend\Page\PageController::class, 'faq'])->name('faq');


        Route::group(["as" => "customer.", "prefix" => "customer", "middleware" => ["auth", "role:customer", 'prevent-back-history']], function () {
            Route::get("dashboard", [\App\Http\Controllers\Frontend\Customer\DashboardController::class, "index"])->name('dashboard');
            Route::get("notification/{notification}", [\App\Http\Controllers\NotificationController::class, "notification"])->name("notification");

            Route::group(['prefix' => 'my-profile', 'as' => 'my-profile.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Customer\ProfileController::class, "showProfile"])->name('show');
                Route::post("/update", [\App\Http\Controllers\Frontend\Customer\ProfileController::class, "updateProfile"])->name('update');
            });

            Route::group(['prefix' => 'change-password', 'as' => 'change-password.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Customer\ChangePasswordController::class, "show"])->name('show');
                Route::post("/", [\App\Http\Controllers\Frontend\Customer\ChangePasswordController::class, "update"])->name('update');
            });

            Route::group(['prefix' => 'make-trip', 'as' => 'make-trip.'], function () {
                Route::post("/make-trip", [\App\Http\Controllers\Frontend\Customer\TripController::class, "store"])->name('store');
                Route::post("/cancel-trip/{trip}", [\App\Http\Controllers\Frontend\Customer\TripController::class, "cancel"])->name('cancel');
                Route::get("/current-trip", [\App\Http\Controllers\Frontend\Customer\TripController::class, "indexCurrent"])->name('current-trip');
                Route::get("/history-trip", [\App\Http\Controllers\Frontend\Customer\TripController::class, "indexHistory"])->name('history-trip');
                Route::get("/show-trip/{trip}", [\App\Http\Controllers\Frontend\Customer\TripController::class, "showTrip"])->name('show-trip');
                Route::group(['prefix' => 'bid-trip', 'as' => 'bid-trip.'], function () {
                    Route::post("/approve/{tripBid}", [\App\Http\Controllers\Frontend\Customer\BidController::class, "bidApprove"])->name('approve');
                    Route::post("/decline/{tripBid}", [\App\Http\Controllers\Frontend\Customer\BidController::class, "bidDecline"])->name('decline');
                });
            });
        });

        Route::group(["as" => "company.", "prefix" => "company", "middleware" => ["auth", "role:company", 'prevent-back-history']], function () {
            Route::get("dashboard", [\App\Http\Controllers\Frontend\Company\DashboardController::class, "index"])->name('dashboard');
            Route::get("notification/{notification}", [\App\Http\Controllers\NotificationController::class, "notification"])->name("notification");
            Route::group(['prefix' => 'my-profile', 'as' => 'my-profile.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Company\ProfileController::class, "showProfile"])->name('show');
                Route::post("/", [\App\Http\Controllers\Frontend\Company\ProfileController::class, "updateProfile"])->name('update');
            });

            Route::group(['prefix' => 'change-password', 'as' => 'change-password.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Company\ChangePasswordController::class, "show"])->name('show');
                Route::post("/", [\App\Http\Controllers\Frontend\Company\ChangePasswordController::class, "update"])->name('update');
            });

            Route::group(['prefix' => 'truck', 'as' => 'truck.'], function () {
                Route::get('/', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'store'])->name('store');
                Route::get('/edit/{truck}', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'edit'])->name('edit');
                Route::put('/{truck}', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'update'])->name('update');
                Route::delete('/{truck}', [\App\Http\Controllers\Frontend\Company\TruckController::class, 'destroy'])->name('destroy');
            });
            Route::group(['prefix' => 'bid', 'as' => 'bid.'], function () {
                Route::get('/', [\App\Http\Controllers\Frontend\Company\BidController::class, 'index'])->name('index');
                Route::get('/{trip}', [\App\Http\Controllers\Frontend\Company\BidController::class, 'show'])->name('show');
                Route::post('/create/{trip}', [\App\Http\Controllers\Frontend\Company\BidController::class, 'create'])->name('create');
            });
            Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
                Route::get("/current-trip", [\App\Http\Controllers\Frontend\Company\TripController::class, "indexCurrent"])->name('current-trip');
                Route::get("/history-trip", [\App\Http\Controllers\Frontend\Company\TripController::class, "indexHistory"])->name('history-trip');
                Route::get("/show-trip/{trip}", [\App\Http\Controllers\Frontend\Company\TripController::class, "showTrip"])->name('show-trip');
                Route::post("/finish/{trip}", [\App\Http\Controllers\Frontend\Company\TripController::class, "finish"])->name('finish');
            });
        });

        Route::group(["as" => "driver.", "prefix" => "driver", "middleware" => ["auth", "role:driver", 'prevent-back-history']], function () {
            Route::get("dashboard", [\App\Http\Controllers\Frontend\Driver\DashboardController::class, "index"])->name('dashboard');
            Route::get("notification/{notification}", [\App\Http\Controllers\NotificationController::class, "notification"])->name("notification");
            Route::group(['prefix' => 'my-profile', 'as' => 'my-profile.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Driver\ProfileController::class, "showProfile"])->name('show');
                Route::post("/", [\App\Http\Controllers\Frontend\Driver\ProfileController::class, "updateProfile"])->name('update');
            });

            Route::group(['prefix' => 'change-password', 'as' => 'change-password.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Driver\ChangePasswordController::class, "show"])->name('show');
                Route::post("/", [\App\Http\Controllers\Frontend\Driver\ChangePasswordController::class, "update"])->name('update');
            });

            Route::group(['prefix' => 'truck', 'as' => 'truck.'], function () {
                Route::get("/", [\App\Http\Controllers\Frontend\Driver\TruckController::class, "show"])->name('show');
                Route::get("/edit/{truck}", [\App\Http\Controllers\Frontend\Driver\TruckController::class, "edit"])->name('edit');
                Route::post("/", [\App\Http\Controllers\Frontend\Driver\TruckController::class, "store"])->name('store');
                Route::put("/{truck}", [\App\Http\Controllers\Frontend\Driver\TruckController::class, "update"])->name('update');
            });
            Route::group(['prefix' => 'bid', 'as' => 'bid.'], function () {
                Route::get('/', [\App\Http\Controllers\Frontend\Driver\BidController::class, 'index'])->name('index');
                Route::get('/{trip}', [\App\Http\Controllers\Frontend\Driver\BidController::class, 'show'])->name('show');
                Route::post('/create/{trip}', [\App\Http\Controllers\Frontend\Driver\BidController::class, 'create'])->name('create');
            });
            Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
                Route::get("/current-trip", [\App\Http\Controllers\Frontend\Driver\TripController::class, "indexCurrent"])->name('current-trip');
                Route::get("/history-trip", [\App\Http\Controllers\Frontend\Driver\TripController::class, "indexHistory"])->name('history-trip');
                Route::get("/show-trip/{trip}", [\App\Http\Controllers\Frontend\Driver\TripController::class, "showTrip"])->name('show-trip');
                Route::post("/finish/{trip}", [\App\Http\Controllers\Frontend\Driver\TripController::class, "finish"])->name('finish');
            });
        });
    }
);

Route::group(
    ["prefix" => "admin", "as" => "admin."],
    function () {

        Route::get('login',  [\App\Http\Controllers\backend\AuthController::class, 'loginPage'])->name('login');
        Route::post('login',  [\App\Http\Controllers\backend\AuthController::class, 'login'])->name('login');

        Route::group(["middleware" => ["auth", "role:admin", 'prevent-back-history']], function () {

            Route::post('logout',  [\App\Http\Controllers\backend\AuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [\App\Http\Controllers\backend\DashboardController::class, 'index'])->name('dashboard');
            Route::get('profile', [\App\Http\Controllers\backend\ProfileController::class, 'show'])->name('profile');
            Route::post('profile', [\App\Http\Controllers\backend\ProfileController::class, 'update'])->name('update');
            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

                Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\AdminsController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\AdminsController::class, 'create'])->name('create');
                    Route::post('/', [\App\Http\Controllers\backend\AdminsController::class, 'store'])->name('store');
                    Route::get('/edit/{user}', [\App\Http\Controllers\backend\AdminsController::class, 'edit'])->name('edit');
                    Route::put('/{user}', [\App\Http\Controllers\backend\AdminsController::class, 'update'])->name('update');
                    Route::put('/change-password/{user}', [\App\Http\Controllers\backend\AdminsController::class, 'changePassword'])->name('change-password');
                    Route::delete('/{user}', [\App\Http\Controllers\backend\AdminsController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\CustomerController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\CustomerController::class, 'create'])->name('create');
                    Route::post('/', [\App\Http\Controllers\backend\CustomerController::class, 'store'])->name('store');
                    Route::get('/edit/{user}', [\App\Http\Controllers\backend\CustomerController::class, 'edit'])->name('edit');
                    Route::put('/{user}', [\App\Http\Controllers\backend\CustomerController::class, 'update'])->name('update');
                    Route::put('/change-password/{user}', [\App\Http\Controllers\backend\CustomerController::class, 'changePassword'])->name('change-password');
                    Route::delete('/{user}', [\App\Http\Controllers\backend\CustomerController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\CompanyController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\CompanyController::class, 'create'])->name('create');
                    Route::get('/{user}', [\App\Http\Controllers\backend\CompanyController::class, 'show'])->name('show');
                    Route::post('/', [\App\Http\Controllers\backend\CompanyController::class, 'store'])->name('store');
                    Route::get('/edit/{user}', [\App\Http\Controllers\backend\CompanyController::class, 'edit'])->name('edit');
                    Route::put('/{user}', [\App\Http\Controllers\backend\CompanyController::class, 'update'])->name('update');
                    Route::put('/change-password/{user}', [\App\Http\Controllers\backend\CompanyController::class, 'changePassword'])->name('change-password');
                    Route::delete('/{user}', [\App\Http\Controllers\backend\CompanyController::class, 'destroy'])->name('destroy');

                    Route::group(['prefix' => 'truck', 'as' => 'truck.'], function () {
                        Route::get('/{company}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'index'])->name('index');
                        Route::get('/create/{company}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'create'])->name('create');
                        Route::post('/{company}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'store'])->name('store');
                        Route::get('/edit/{company}/{truck}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'edit'])->name('edit');
                        Route::put('/{company}/{truck}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'update'])->name('update');
                        Route::delete('/{company}/{truck}', [\App\Http\Controllers\backend\CompanyTruckController::class, 'destroy'])->name('destroy');
                    });
                });

                Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\DriverController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\DriverController::class, 'create'])->name('create');
                    Route::get('/{user}', [\App\Http\Controllers\backend\DriverController::class, 'show'])->name('show');
                    Route::post('/', [\App\Http\Controllers\backend\DriverController::class, 'store'])->name('store');
                    Route::get('/edit/{user}', [\App\Http\Controllers\backend\DriverController::class, 'edit'])->name('edit');
                    Route::put('/{user}', [\App\Http\Controllers\backend\DriverController::class, 'update'])->name('update');
                    Route::put('/change-password/{user}', [\App\Http\Controllers\backend\DriverController::class, 'changePassword'])->name('change-password');
                    Route::delete('/{user}', [\App\Http\Controllers\backend\DriverController::class, 'destroy'])->name('destroy');

                    Route::group(['prefix' => 'truck', 'as' => 'truck.'], function () {
                        Route::get('/create/{driver}', [\App\Http\Controllers\backend\DriverTruckController::class, 'create'])->name('create');
                        Route::post('/{driver}', [\App\Http\Controllers\backend\DriverTruckController::class, 'store'])->name('store');
                        Route::put('/{driver}/{truck}', [\App\Http\Controllers\backend\DriverTruckController::class, 'update'])->name('update');
                    });
                });

                Route::group(['prefix' => 'company-type', 'as' => 'company-type.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\CompanyTypeController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\CompanyTypeController::class, 'create'])->name('create');
                    Route::post('/', [\App\Http\Controllers\backend\CompanyTypeController::class, 'store'])->name('store');
                    Route::get('/edit/{companyType}', [\App\Http\Controllers\backend\CompanyTypeController::class, 'edit'])->name('edit');
                    Route::put('/{companyType}', [\App\Http\Controllers\backend\CompanyTypeController::class, 'update'])->name('update');
                    Route::delete('/{companyType}', [\App\Http\Controllers\backend\CompanyTypeController::class, 'destroy'])->name('destroy');
                });
            });

            Route::group(['prefix' => 'trucks', 'as' => 'trucks.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckController::class, 'index'])->name('index');
                Route::get('/user/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'user'])->name('user');
                Route::post('/accept/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'accept'])->name('accept');
                Route::post('/reject/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'reject'])->name('reject');
                Route::get('/edit/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'edit'])->name('edit');
                Route::put('/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'update'])->name('update');
                Route::delete('/{truck}', [\App\Http\Controllers\backend\TruckController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'truck-category', 'as' => 'truck-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckCategory}', [\App\Http\Controllers\backend\TruckCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckCategory}', [\App\Http\Controllers\backend\TruckCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckCategory}', [\App\Http\Controllers\backend\TruckCategoryController::class, 'destroy'])->name('destroy');
            });

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

            Route::group(['prefix' => 'truck-trip-category', 'as' => 'truck-trip-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{truckTripCategory}', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'edit'])->name('edit');
                Route::put('/{truckTripCategory}', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'update'])->name('update');
                Route::delete('/{truckTripCategory}', [\App\Http\Controllers\backend\TruckTripCategoryController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'product-type', 'as' => 'product-type.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\ProductTypeController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\ProductTypeController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\ProductTypeController::class, 'store'])->name('store');
                Route::get('/edit/{productType}', [\App\Http\Controllers\backend\ProductTypeController::class, 'edit'])->name('edit');
                Route::put('/{productType}', [\App\Http\Controllers\backend\ProductTypeController::class, 'update'])->name('update');
                Route::delete('/{productType}', [\App\Http\Controllers\backend\ProductTypeController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'blog-category', 'as' => 'blog-category.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\BlogCategoryController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\BlogCategoryController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\BlogCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{blogCategory}', [\App\Http\Controllers\backend\BlogCategoryController::class, 'edit'])->name('edit');
                Route::put('/{blogCategory}', [\App\Http\Controllers\backend\BlogCategoryController::class, 'update'])->name('update');
                Route::delete('/{blogCategory}', [\App\Http\Controllers\backend\BlogCategoryController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\BlogController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\backend\BlogController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\backend\BlogController::class, 'store'])->name('store');
                Route::get('/edit/{blog}', [\App\Http\Controllers\backend\BlogController::class, 'edit'])->name('edit');
                Route::put('/{blog}', [\App\Http\Controllers\backend\BlogController::class, 'update'])->name('update');
                Route::delete('/{blog}', [\App\Http\Controllers\backend\BlogController::class, 'destroy'])->name('destroy');
            });
            Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
                Route::get('/', [\App\Http\Controllers\backend\ContactController::class, 'index'])->name('index');
                Route::get('/{contact}', [\App\Http\Controllers\backend\ContactController::class, 'show'])->name('show');
                Route::delete('/{contact}', [\App\Http\Controllers\backend\ContactController::class, 'destroy'])->name('destroy');
            });
            Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
                Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\SliderController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\SliderController::class, 'create'])->name('create');
                    Route::post('/', [\App\Http\Controllers\backend\SliderController::class, 'store'])->name('store');
                    Route::get('/edit/{slider}', [\App\Http\Controllers\backend\SliderController::class, 'edit'])->name('edit');
                    Route::put('/{slider}', [\App\Http\Controllers\backend\SliderController::class, 'update'])->name('update');
                    Route::delete('/{slider}', [\App\Http\Controllers\backend\SliderController::class, 'destroy'])->name('destroy');
                });
                Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
                    Route::get('/', [\App\Http\Controllers\backend\ClientController::class, 'index'])->name('index');
                    Route::get('/create', [\App\Http\Controllers\backend\ClientController::class, 'create'])->name('create');
                    Route::post('/', [\App\Http\Controllers\backend\ClientController::class, 'store'])->name('store');
                    Route::get('/edit/{client}', [\App\Http\Controllers\backend\ClientController::class, 'edit'])->name('edit');
                    Route::put('/{client}', [\App\Http\Controllers\backend\ClientController::class, 'update'])->name('update');
                    Route::delete('/{client}', [\App\Http\Controllers\backend\ClientController::class, 'destroy'])->name('destroy');
                });
            });
        });
    }
);

Route::get("login", function () {
    return redirect("/");
})->name("login");

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');