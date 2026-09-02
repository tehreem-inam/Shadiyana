<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaxonomyController;

use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorTaxonomyController;
use App\Http\Controllers\VendorServiceController;
use App\Http\Controllers\VendorEventTypeController;
use App\Http\Controllers\VendorImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;






Route::get('/', [HomeController::class, 'index'])
    ->name('home');


Route::get('/listings', [ListingController::class, 'index']) ->name('public.listings.index');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Shadiyana Web Application Routes
|
*/


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| Guest users only.
|
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    )->name('login.store');


    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/register',
        [AuthController::class, 'showRegister']
    )->name('register');

    Route::post(
        '/register',
        [AuthController::class, 'register']
    )->name('register.store');

});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| These routes are available to authenticated users.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [AuthController::class, 'profile']
    )->name('profile');


    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/change-password',
        [AuthController::class, 'showChangePassword']
    )->name('password.change');

    Route::post(
        '/change-password',
        [AuthController::class, 'changePassword']
    )->name('password.update');


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Vendor Management Routes
    |--------------------------------------------------------------------------
    |
    | Vendor-specific routes that can be accessed by BOTH:
    |
    | - Super Admin
    | - Vendor
    |
    | The controller/policy should determine whether the authenticated
    | user is allowed to manage the specified vendor.
    |
    */

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | Vendor Taxonomies
            |--------------------------------------------------------------------------
            */

            Route::prefix('{vendor}/taxonomies')
                ->name('taxonomies.')
                ->group(function () {

                    Route::get(
                        '/',
                        [VendorTaxonomyController::class, 'index']
                    )->name('index');

                    Route::get(
                        '/create',
                        [VendorTaxonomyController::class, 'create']
                    )->name('create');

                    Route::post(
                        '/',
                        [VendorTaxonomyController::class, 'store']
                    )->name('store');

                    Route::get(
                        '/{vendorTaxonomy}/edit',
                        [VendorTaxonomyController::class, 'edit']
                    )->name('edit');

                    Route::put(
                        '/{vendorTaxonomy}',
                        [VendorTaxonomyController::class, 'update']
                    )->name('update');

                    Route::delete(
                        '/{vendorTaxonomy}',
                        [VendorTaxonomyController::class, 'destroy']
                    )->name('destroy');

                });


            /*
            |--------------------------------------------------------------------------
            | Vendor Services
            |--------------------------------------------------------------------------
            |
            | Accessible by:
            |
            | - Super Admin
            | - Vendor
            |
            */

            Route::prefix('{vendor}/services')
                ->name('services.')
                ->group(function () {

                    /*
                    |------------------------------------------------------------------
                    | Vendor Services Listing
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/',
                        [VendorServiceController::class, 'index']
                    )->name('index');


                    /*
                    |------------------------------------------------------------------
                    | Create Vendor Service
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/create',
                        [VendorServiceController::class, 'create']
                    )->name('create');


                    /*
                    |------------------------------------------------------------------
                    | Store Vendor Service
                    |------------------------------------------------------------------
                    */

                    Route::post(
                        '/',
                        [VendorServiceController::class, 'store']
                    )->name('store');


                    /*
                    |------------------------------------------------------------------
                    | Edit Vendor Service
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/{vendorService}/edit',
                        [VendorServiceController::class, 'edit']
                    )->name('edit');


                    /*
                    |------------------------------------------------------------------
                    | Update Vendor Service
                    |------------------------------------------------------------------
                    */

                    Route::put(
                        '/{vendorService}',
                        [VendorServiceController::class, 'update']
                    )->name('update');


                    /*
                    |------------------------------------------------------------------
                    | Delete Vendor Service
                    |------------------------------------------------------------------
                    */

                    Route::delete(
                        '/{vendorService}',
                        [VendorServiceController::class, 'destroy']
                    )->name('destroy');


                    /*
                    |------------------------------------------------------------------
                    | Toggle Vendor Service Status
                    |------------------------------------------------------------------
                    */

                    Route::patch(
                        '/{vendorService}/status',
                        [VendorServiceController::class, 'toggleStatus']
                    )->name('toggle-status');

                });


            /*
            |--------------------------------------------------------------------------
            | Vendor Event Types
            |--------------------------------------------------------------------------
            |
            | Accessible by:
            |
            | - Super Admin
            | - Vendor
            |
            */

            Route::prefix('{vendor}/event-types')
                ->name('event-types.')
                ->group(function () {

                    /*
                    |------------------------------------------------------------------
                    | Vendor Event Types Listing
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/',
                        [VendorEventTypeController::class, 'index']
                    )->name('index');


                    /*
                    |------------------------------------------------------------------
                    | Create Vendor Event Type
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/create',
                        [VendorEventTypeController::class, 'create']
                    )->name('create');


                    /*
                    |------------------------------------------------------------------
                    | Store Vendor Event Type
                    |------------------------------------------------------------------
                    */

                    Route::post(
                        '/',
                        [VendorEventTypeController::class, 'store']
                    )->name('store');


                    /*
                    |------------------------------------------------------------------
                    | Edit Vendor Event Type
                    |------------------------------------------------------------------
                    */

                    Route::get(
                        '/{vendorEventType}/edit',
                        [VendorEventTypeController::class, 'edit']
                    )->name('edit');


                    /*
                    |------------------------------------------------------------------
                    | Update Vendor Event Type
                    |------------------------------------------------------------------
                    */

                    Route::put(
                        '/{vendorEventType}',
                        [VendorEventTypeController::class, 'update']
                    )->name('update');


                    /*
                    |------------------------------------------------------------------
                    | Delete Vendor Event Type
                    |------------------------------------------------------------------
                    */

                    Route::delete(
                        '/{vendorEventType}',
                        [VendorEventTypeController::class, 'destroy']
                    )->name('destroy');

                });

        });

});


/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
|
| Only Super Admin can access these routes.
|
*/

Route::middleware([
    'auth',
    'role:superadmin',
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('users')
        ->name('users.')
        ->group(function () {

            Route::get(
                '/',
                [UserController::class, 'getUsers']
            )->name('index');

            Route::get(
                '/create',
                [UserController::class, 'createUser']
            )->name('create');

            Route::post(
                '/',
                [UserController::class, 'storeUser']
            )->name('store');

            Route::get(
                '/{id}',
                [UserController::class, 'getUserById']
            )->name('show');

            Route::get(
                '/{id}/edit',
                [UserController::class, 'editUser']
            )->name('edit');

            Route::put(
                '/{id}',
                [UserController::class, 'updateUser']
            )->name('update');

            Route::delete(
                '/{id}',
                [UserController::class, 'deleteUser']
            )->name('destroy');

        });


    /*
    |--------------------------------------------------------------------------
    | Location Management
    |--------------------------------------------------------------------------
    */

    Route::prefix('locations')
        ->name('locations.')
        ->group(function () {

            Route::resource(
                'states',
                StateController::class
            );

            Route::resource(
                'cities',
                CityController::class
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Taxonomy Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'taxonomies',
        TaxonomyController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Event Type Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'event-types',
        EventTypeController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Event Type Images
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/event-types/{eventType}/images/{image}',
        [EventTypeController::class, 'destroyImage']
    )->name('event-types.images.destroy');


    /*
    |--------------------------------------------------------------------------
    | Service Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'services',
        ServiceController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Vendor Management
    |--------------------------------------------------------------------------
    |
    | These routes are ONLY for Super Admin vendor management.
    |
    */

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {

            Route::get(
                '/',
                [VendorController::class, 'index']
            )->name('index');

            Route::get(
                '/create',
                [VendorController::class, 'create']
            )->name('create');

            Route::post(
                '/',
                [VendorController::class, 'store']
            )->name('store');

            Route::get(
                '/{vendor}',
                [VendorController::class, 'show']
            )->name('show');

            Route::get(
                '/{vendor}/edit',
                [VendorController::class, 'edit']
            )->name('edit');

            Route::put(
                '/{vendor}',
                [VendorController::class, 'update']
            )->name('update');

            Route::delete(
                '/{vendor}',
                [VendorController::class, 'destroy']
            )->name('destroy');


            /*
            |--------------------------------------------------------------------------
            | Vendor Logo
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{vendor}/logo',
                [VendorController::class, 'destroyLogo']
            )->name('logo.destroy');


            /*
            |--------------------------------------------------------------------------
            | Vendor Cover Image
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{vendor}/cover',
                [VendorController::class, 'destroyCover']
            )->name('cover.destroy');

        });

});


/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
|
| Vendor-only routes.
|
| Vendor Services and Vendor Event Types are NOT defined here because
| they are already registered in the authenticated routes section.
|
*/

Route::middleware([
    'auth',
    'role:vendor',
])->group(function () {

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | Vendor Images / Gallery
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{vendor}/images',
                [VendorImageController::class, 'index']
            )->name('images.index');

            Route::get(
                '/{vendor}/images/create',
                [VendorImageController::class, 'create']
            )->name('images.create');

            Route::post(
                '/{vendor}/images',
                [VendorImageController::class, 'store']
            )->name('images.store');

            Route::get(
                '/{vendor}/images/{image}/edit',
                [VendorImageController::class, 'edit']
            )->name('images.edit');

            Route::put(
                '/{vendor}/images/{image}',
                [VendorImageController::class, 'update']
            )->name('images.update');

            Route::delete(
                '/{vendor}/images/{image}',
                [VendorImageController::class, 'destroy']
            )->name('images.destroy');


            /*
            |--------------------------------------------------------------------------
            | Vendor Image Status
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/{vendor}/images/{image}/status',
                [VendorImageController::class, 'toggleStatus']
            )->name('images.toggle-status');


            /*
            |--------------------------------------------------------------------------
            | Vendor Image Sort Order
            |--------------------------------------------------------------------------
            */

            Route::patch(
                '/{vendor}/images/{image}/sort-order',
                [VendorImageController::class, 'updateSortOrder']
            )->name('images.sort-order');

        });

});

