<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the Super Admin login form.
     */
    public function showSuperAdminLogin()
    {
        // If already logged in as superadmin, redirect to dashboard
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return redirect()->route('dashboard');
        }

        return view('auth.superadmin-login');
    }

    /**
     * Handle the Super Admin login request.
     */
    public function superAdminLogin(Request $request)
    {
        // Validate login form inputs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login using the web guard
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            // Only allow superadmin role
            if ($user && $user->role === 'superadmin') {
                return redirect()->route('dashboard')
                    ->with('flash_message', 'Welcome Super Admin!');
            }

            // Not a superadmin — log out immediately
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Access denied. Only Super Admins can log in here.'
            ])->onlyInput('email');
        }

        // Invalid credentials
        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ])->onlyInput('email');
    }

    /**
     * Logout the user and redirect to login page.
     */
  public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('superadmin.login')
        ->with('success', 'You have been logged out successfully.');
}
}
