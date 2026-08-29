<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
  
    // | Show Login Page
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // | Login
  

public function login(Request $request): RedirectResponse
{
   
    $validated = $request->validate([
        'login' => [
            'required',
            'string',
        ],

        'password' => [
            'required',
            'string',
        ],
    ]);

    // | Determine Login Type

    $login = trim($validated['login']);

    $field = filter_var($login, FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'phone_number';

    // | Build Credentials

    $credentials = [
        $field => $login,
        'password' => $validated['password'],
        'status' => 'active',
    ];


    // | Remember Me


    $remember = $request->boolean('remember');



    // | Attempt Authentication


    if (!Auth::guard('web')->attempt($credentials, $remember)) {

        return back()
            ->withErrors([
                'login' => 'The provided email/phone number or password is incorrect.',
            ])
            ->withInput(
                $request->only('login')
            );
    }
    
    /*
    |--------------------------------------------------------------------------
    | Regenerate Session
    |--------------------------------------------------------------------------
    */

    $request->session()->regenerate();

    /*
    |--------------------------------------------------------------------------
    | Get Authenticated User
    |--------------------------------------------------------------------------
    */

    /** @var \App\Models\User $user */

    $user = Auth::guard('web')->user();


    /*
    |--------------------------------------------------------------------------
    | Update Last Login
    |--------------------------------------------------------------------------
    */

    $user->update([
        'last_login_at' => now(),
    ]);
  /*
    |--------------------------------------------------------------------------
    | Role-Based Dashboard
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->intended(route('dashboard'));
}

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Logout From Web Guard
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();

        /*
        |--------------------------------------------------------------------------
        | Invalidate Session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();
        
        /*
        |--------------------------------------------------------------------------
        | Regenerate CSRF Token
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();


        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show Register Page
    |--------------------------------------------------------------------------
   */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | Register
    |--------------------------------------------------------------------------
  */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone_number' => [
                'required',
                'string',
                'max:30',
                'unique:users,phone_number',
            ],

            'country_code' => [
                'required',
                'string',
                'max:10',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Create Customer
        |--------------------------------------------------------------------------
        |
        | Public registration creates customers only.
        |
        | Vendors are created/managed through the vendor workflow.
        |
        */

        $user = User::create([

            'first_name' =>
                $validated['first_name'],

            'last_name' =>
                $validated['last_name'],

            'email' =>
                $validated['email'],

            'phone_number' =>
                $validated['phone_number'],

            'country_code' =>
                $validated['country_code'],

            'password' =>
                $validated['password'],

            'role' =>
                'customer',

            'is_verified' =>
                false,

            'status' =>
                'active',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Login Newly Registered User
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->login($user);

        $request->session()->regenerate();


        return redirect()
            ->intended(route('dashboard'))
            ->with(
                'success',
                'Your account has been created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    public function profile(): View
    {
        $user = Auth::guard('web')->user();

        return view(
            'auth.profile',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Change Password
    |--------------------------------------------------------------------------
    */

    public function showChangePassword(): View
    {
        return view('auth.change-password');
    }


    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    public function changePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'current_password' => [
                'required',
                'current_password:web',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ]);


        $user = Auth::guard('web')->user();

        $user->update([
            'password' => $validated['password'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Logout Other Sessions / Re-authentication
        |--------------------------------------------------------------------------
        |
        | We keep the current session active.
        |
        */

        return redirect()
            ->route('profile')
            ->with(
                'success',
                'Your password has been changed successfully.'
            );
    }
}