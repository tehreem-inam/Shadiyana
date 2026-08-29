<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    |
    | Single dashboard entry point for all authenticated users.
    |
    | The dashboard content is determined by the authenticated user's role.
    |
    | Supported roles:
    |
    | - superadmin
    | - vendor
    | - customer
    |
    */

    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Safety Check
        |--------------------------------------------------------------------------
        |
        | This controller should normally only be accessible through the
        | "auth" middleware. This additional check keeps the controller
        | defensive if it is ever called from another location.
        |
        */

        if (! $user) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Vendor Information
        |--------------------------------------------------------------------------
        |
        | Only load the vendor relationship when the authenticated user
        | is actually a vendor.
        |
        */

        $vendor = null;

        if ($user->isVendor()) {
            $vendor = $user->vendor;
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        |
        | These are intentionally kept lightweight for now.
        |
        | Module-specific statistics can be added later when Packages,
        | Availability, Deals, Inquiries, Bookings and Reviews are implemented.
        |
        */

        $stats = [];

        /*
        |--------------------------------------------------------------------------
        | Super Admin Statistics
        |--------------------------------------------------------------------------
        */

        if ($user->isSuperAdmin()) {

            $stats = [
                'type' => 'superadmin',

                'title' => 'Super Admin Dashboard',

                'description' =>
                    'Manage Shadiyana users, vendors and marketplace content.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Vendor Statistics
        |--------------------------------------------------------------------------
        */

        elseif ($user->isVendor()) {

            $stats = [
                'type' => 'vendor',

                'title' => 'Vendor Dashboard',

                'description' =>
                    'Manage your vendor profile, services, event types and business.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Customer Statistics
        |--------------------------------------------------------------------------
        |
        | Customer dashboard functionality can be implemented later.
        |
        */

        elseif ($user->isCustomer()) {

            $stats = [
                'type' => 'customer',

                'title' => 'Customer Dashboard',

                'description' =>
                    'Manage your profile, inquiries, bookings and reviews.',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Unknown Role
        |--------------------------------------------------------------------------
        |
        | Do not allow an unexpected role to enter the dashboard.
        |
        */

        else {

            abort(
                403,
                'You are not authorized to access the dashboard.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard.index',
            compact(
                'user',
                'vendor',
                'stats'
            )
        );
    }
}

