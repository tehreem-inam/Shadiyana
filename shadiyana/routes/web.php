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
use App\Http\Controllers\PackageController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\EventLandingController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');


/*
|--------------------------------------------------------------------------
| Public Vendor Listings
|--------------------------------------------------------------------------
*/

Route::get(
    '/listings',
    [ListingController::class, 'index']
)->name('public.listings.index');


/*
|--------------------------------------------------------------------------
| Public Event Landing Pages
|--------------------------------------------------------------------------
*/

Route::get(
    '/events',
    [EventLandingController::class, 'index']
)->name('events.index');

Route::get(
    '/events/{slug}',
    [EventLandingController::class, 'show']
)->name('events.show');




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
Route::get('/vendor/register', [AuthController::class, 'showVendorRegister'])
    ->name('vendor.register');

Route::post('/vendor/register', [AuthController::class, 'registerVendor'])
    ->name('vendor.register.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes available to authenticated users.
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
    | Package Management
    |--------------------------------------------------------------------------
    |
    | Vendor      -> only their own packages
    | Super Admin -> all packages
    |
    */

    Route::resource(
        'vendors/{vendor}/packages',
        PackageController::class
    )
        ->whereNumber('vendor')
        ->names('vendors.packages');


    /*
    |--------------------------------------------------------------------------
    | Vendor Taxonomies
    |--------------------------------------------------------------------------
    */

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {

            Route::prefix('{vendor}/taxonomies')
                ->whereNumber('vendor')
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
            */

            Route::prefix('{vendor}/services')
                ->whereNumber('vendor')
                ->name('services.')
                ->group(function () {

                    Route::get(
                        '/',
                        [VendorServiceController::class, 'index']
                    )->name('index');

                    Route::get(
                        '/create',
                        [VendorServiceController::class, 'create']
                    )->name('create');

                    Route::post(
                        '/',
                        [VendorServiceController::class, 'store']
                    )->name('store');

                    Route::get(
                        '/{vendorService}/edit',
                        [VendorServiceController::class, 'edit']
                    )->name('edit');

                    Route::put(
                        '/{vendorService}',
                        [VendorServiceController::class, 'update']
                    )->name('update');

                    Route::delete(
                        '/{vendorService}',
                        [VendorServiceController::class, 'destroy']
                    )->name('destroy');

                    Route::patch(
                        '/{vendorService}/status',
                        [VendorServiceController::class, 'toggleStatus']
                    )->name('toggle-status');

                });


            /*
            |--------------------------------------------------------------------------
            | Vendor Event Types
            |--------------------------------------------------------------------------
            */

            Route::prefix('{vendor}/event-types')
                ->whereNumber('vendor')
                ->name('event-types.')
                ->group(function () {

                    Route::get(
                        '/',
                        [VendorEventTypeController::class, 'index']
                    )->name('index');

                    Route::get(
                        '/create',
                        [VendorEventTypeController::class, 'create']
                    )->name('create');

                    Route::post(
                        '/',
                        [VendorEventTypeController::class, 'store']
                    )->name('store');

                    Route::get(
                        '/{vendorEventType}/edit',
                        [VendorEventTypeController::class, 'edit']
                    )->name('edit');

                    Route::put(
                        '/{vendorEventType}',
                        [VendorEventTypeController::class, 'update']
                    )->name('update');

                    Route::delete(
                        '/{vendorEventType}',
                        [VendorEventTypeController::class, 'destroy']
                    )->name('destroy');

                });

        });

});


/*
|--------------------------------------------------------------------------
| Vendor Gallery Routes
|--------------------------------------------------------------------------
|
| Vendor is selected through the query string:
|
| /vendors/images?vendor=9
| /vendors/images/create?vendor=9
| /vendors/images/15?vendor=9
| /vendors/images/15/edit?vendor=9
|
| Both Vendor and Super Admin can use these routes.
| Authorization is handled inside VendorImageController.
|
*/

Route::middleware('auth')->group(function () {

    Route::prefix('vendors')
        ->name('vendors.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Gallery Index
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/images',
                [VendorImageController::class, 'index']
            )->name('images.index');


            /*
            |--------------------------------------------------------------------------
            | Create Gallery Image
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/images/create',
                [VendorImageController::class, 'create']
            )->name('images.create');


            /*
            |--------------------------------------------------------------------------
            | Store Gallery Images
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/images',
                [VendorImageController::class, 'store']
            )->name('images.store');


            /*
            |--------------------------------------------------------------------------
            | Reorder Gallery Images
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/images/reorder',
                [VendorImageController::class, 'reorder']
            )->name('images.reorder');


            /*
            |--------------------------------------------------------------------------
            | Show Gallery Image
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/images/{image}',
                [VendorImageController::class, 'show']
            )
                ->whereNumber('image')
                ->name('images.show');


            /*
            |--------------------------------------------------------------------------
            | Edit Gallery Image
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/images/{image}/edit',
                [VendorImageController::class, 'edit']
            )
                ->whereNumber('image')
                ->name('images.edit');


            /*
            |--------------------------------------------------------------------------
            | Update Gallery Image
            |--------------------------------------------------------------------------
            */

            Route::put(
                '/images/{image}',
                [VendorImageController::class, 'update']
            )
                ->whereNumber('image')
                ->name('images.update');


            /*
            |--------------------------------------------------------------------------
            | Delete Gallery Image
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/images/{image}',
                [VendorImageController::class, 'destroy']
            )
                ->whereNumber('image')
                ->name('images.destroy');

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

            /*
            |--------------------------------------------------------------------------
            | Vendor Index
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/',
                [VendorController::class, 'index']
            )->name('index');


            /*
            |--------------------------------------------------------------------------
            | Create Vendor
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/create',
                [VendorController::class, 'create']
            )->name('create');


            /*
            |--------------------------------------------------------------------------
            | Store Vendor
            |--------------------------------------------------------------------------
            */

            Route::post(
                '/',
                [VendorController::class, 'store']
            )->name('store');


            /*
            |--------------------------------------------------------------------------
            | Show Vendor
            |--------------------------------------------------------------------------
            |
            | Admin vendor details.
            |
            | Example:
            |
            | /vendors/12
            |
            */

            Route::get(
                '/{vendor}',
                [VendorController::class, 'show']
            )
                ->whereNumber('vendor')
                ->name('show');


            /*
            |--------------------------------------------------------------------------
            | Edit Vendor
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/{vendor}/edit',
                [VendorController::class, 'edit']
            )
                ->whereNumber('vendor')
                ->name('edit');


            /*
            |--------------------------------------------------------------------------
            | Update Vendor
            |--------------------------------------------------------------------------
            */

            Route::put(
                '/{vendor}',
                [VendorController::class, 'update']
            )
                ->whereNumber('vendor')
                ->name('update');


            /*
            |--------------------------------------------------------------------------
            | Delete Vendor
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{vendor}',
                [VendorController::class, 'destroy']
            )
                ->whereNumber('vendor')
                ->name('destroy');


            /*
            |--------------------------------------------------------------------------
            | Vendor Logo
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{vendor}/logo',
                [VendorController::class, 'destroyLogo']
            )
                ->whereNumber('vendor')
                ->name('logo.destroy');


            /*
            |--------------------------------------------------------------------------
            | Vendor Cover Image
            |--------------------------------------------------------------------------
            */

            Route::delete(
                '/{vendor}/cover',
                [VendorController::class, 'destroyCover']
            )
                ->whereNumber('vendor')
                ->name('cover.destroy');

        });

});
/*
|--------------------------------------------------------------------------
| Public Vendor Profile
|--------------------------------------------------------------------------
|
| Public vendor profile using the vendor slug.
|
| Examples:
|
| /vendors/arena
| /vendors/hifsa-khan-salon
|
| This route is intentionally placed AFTER:
|
| /vendors/images
| /vendors/images/...
| /vendors/{vendor}        (admin numeric route)
|
*/

Route::get(
    '/vendors/{slug}',
    [ListingController::class, 'show']
)
    ->where('slug', '[A-Za-z][A-Za-z0-9-]*')
    ->name('public.vendors.show');