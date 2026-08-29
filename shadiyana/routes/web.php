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
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


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
| Roles:
|
| - Super Admin
| - Vendor
| - Customer
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
    |
    | Every authenticated user can access the dashboard.
    |
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Vendor Taxonomies
    |--------------------------------------------------------------------------
    |
    | Vendor Taxonomy routes are intentionally registered ONCE.
    |
    | Both Super Admin and Vendor users work with the same vendor-specific
    | taxonomy URLs:
    |
    | /vendors/{vendor}/taxonomies
    |
    | Super Admin:
    | - Can manage taxonomies for any vendor.
    |
    | Vendor:
    | - Should manage only their own vendor taxonomy records.
    |
    | The authorization/ownership check should be handled at the
    | controller/policy level.
    |
    */

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {

            Route::prefix('{vendor}/taxonomies')
                ->name('taxonomies.')
                ->group(function () {

                    /*
                    |--------------------------------------------------------------------------
                    | Vendor Taxonomy Listing
                    |--------------------------------------------------------------------------
                    */

                    Route::get(
                        '/',
                        [VendorTaxonomyController::class, 'index']
                    )->name('index');


                    /*
                    |--------------------------------------------------------------------------
                    | Create Vendor Taxonomy
                    |--------------------------------------------------------------------------
                    */

                    Route::get(
                        '/create',
                        [VendorTaxonomyController::class, 'create']
                    )->name('create');


                    /*
                    |--------------------------------------------------------------------------
                    | Store Vendor Taxonomy
                    |--------------------------------------------------------------------------
                    */

                    Route::post(
                        '/',
                        [VendorTaxonomyController::class, 'store']
                    )->name('store');


                    /*
                    |--------------------------------------------------------------------------
                    | Edit Vendor Taxonomy
                    |--------------------------------------------------------------------------
                    */

                    Route::get(
                        '/{vendorTaxonomy}/edit',
                        [VendorTaxonomyController::class, 'edit']
                    )->name('edit');


                    /*
                    |--------------------------------------------------------------------------
                    | Update Vendor Taxonomy
                    |--------------------------------------------------------------------------
                    */

                    Route::put(
                        '/{vendorTaxonomy}',
                        [VendorTaxonomyController::class, 'update']
                    )->name('update');


                    /*
                    |--------------------------------------------------------------------------
                    | Delete Vendor Taxonomy
                    |--------------------------------------------------------------------------
                    */

                    Route::delete(
                        '/{vendorTaxonomy}',
                        [VendorTaxonomyController::class, 'destroy']
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

            /*
            |--------------------------------------------------------------------------
            | User Listing
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/',
                [UserController::class, 'getUsers']
            )->name('index');


            /*
            |--------------------------------------------------------------------------
            | Create User
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/create',
                [UserController::class, 'createUser']
            )->name('create');


            /*
            |--------------------------------------------------------------------------
            | Store User
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/',
                [UserController::class, 'storeUser']
            )->name('store');


            /*
            |--------------------------------------------------------------------------
            | Show User
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{id}',
                [UserController::class, 'getUserById']
            )->name('show');


            /*
            |--------------------------------------------------------------------------
            | Edit User
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{id}/edit',
                [UserController::class, 'editUser']
            )->name('edit');


            /*
            |--------------------------------------------------------------------------
            | Update User
            |--------------------------------------------------------------------------
            */

            Route::put(
                '/{id}',
                [UserController::class, 'updateUser']
            )->name('update');


            /*
            |--------------------------------------------------------------------------
            | Delete User
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | States
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'states',
                StateController::class
            );


            /*
            |--------------------------------------------------------------------------
            | Cities
            |--------------------------------------------------------------------------
            */

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
    |
    | Images belonging to an Event Type.
    |
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
    | These routes are for Super Admin vendor management.
    |
    */

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Vendor CRUD
            |--------------------------------------------------------------------------
            */

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
| These routes are available only to authenticated Vendors.
|
| IMPORTANT:
|
| Vendor Taxonomy routes are NOT duplicated here because they are already
| registered in the authenticated routes section above.
|
| This prevents duplicate URI/route-name conflicts.
|
| Ownership authorization for the current vendor should be enforced
| inside the relevant controller/policy.
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
            | Vendor Services
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{vendor}/services',
                [VendorServiceController::class, 'index']
            )->name('services.index');

            Route::get(
                '/{vendor}/services/create',
                [VendorServiceController::class, 'create']
            )->name('services.create');

            Route::post(
                '/{vendor}/services',
                [VendorServiceController::class, 'store']
            )->name('services.store');

            Route::get(
                '/{vendor}/services/{vendorService}/edit',
                [VendorServiceController::class, 'edit']
            )->name('services.edit');

            Route::put(
                '/{vendor}/services/{vendorService}',
                [VendorServiceController::class, 'update']
            )->name('services.update');

            Route::delete(
                '/{vendor}/services/{vendorService}',
                [VendorServiceController::class, 'destroy']
            )->name('services.destroy');

            Route::patch(
                '/{vendor}/services/{vendorService}/status',
                [VendorServiceController::class, 'toggleStatus']
            )->name('services.toggle-status');


            /*
            |--------------------------------------------------------------------------
            | Vendor Event Types
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{vendor}/event-types',
                [VendorEventTypeController::class, 'index']
            )->name('event-types.index');

            Route::get(
                '/{vendor}/event-types/create',
                [VendorEventTypeController::class, 'create']
            )->name('event-types.create');

            Route::post(
                '/{vendor}/event-types',
                [VendorEventTypeController::class, 'store']
            )->name('event-types.store');

            Route::get(
                '/{vendor}/event-types/{vendorEventType}/edit',
                [VendorEventTypeController::class, 'edit']
            )->name('event-types.edit');

            Route::put(
                '/{vendor}/event-types/{vendorEventType}',
                [VendorEventTypeController::class, 'update']
            )->name('event-types.update');

            Route::delete(
                '/{vendor}/event-types/{vendorEventType}',
                [VendorEventTypeController::class, 'destroy']
            )->name('event-types.destroy');


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