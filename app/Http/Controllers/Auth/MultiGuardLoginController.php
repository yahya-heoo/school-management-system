<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class MultiGuardLoginController extends Controller
{
    // Show login form for a specific guard
    public function showLoginForm($guard = null)
    {
        // If no guard specified, show role selection page
        if (!$guard) {
            return view('auth.role-selection');
        }

        // Validate the guard
        $guards = ['student', 'teacher', 'parent', 'web'];
        if (!in_array($guard, $guards)) {
            abort(404);
        }

        // Store the intended guard in session
        session(['login_guard' => $guard]);

        // Return the appropriate view
        return view("auth.{$guard}-login");
    }

    // Handle login for all guards
    public function login(Request $request)
    {
        // Get the guard from session or request
        $guard = session('login_guard') ?? $request->input('guard', 'web');

        // Validate credentials
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Throttle login attempts
        $this->ensureIsNotRateLimited($request, $guard);

        // Attempt authentication with specific guard
        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request, $guard));

            // Redirect to appropriate dashboard
            return $this->authenticated($request, Auth::guard($guard)->user(), $guard);
        }

        // If authentication fails
        RateLimiter::hit($this->throttleKey($request, $guard));

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Handle logout for all guards
    public function logout(Request $request)
    {
        $guard = Auth::getDefaultDriver();
        
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to role selection page
        return redirect()->route('role.selection');
    }

    // Handle successful authentication
    protected function authenticated(Request $request, $user, $guard)
    {
        $routes = [
            'student' => 'student.dashboard',
            'teacher' => 'teacher.dashboard',
            'parent' => 'parent.dashboard',
            'web' => 'dashboard', // admin
        ];

        return redirect()->intended(route($routes[$guard] ?? 'dashboard'));
    }

    // Throttling methods
    protected function ensureIsNotRateLimited(Request $request, $guard)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request, $guard), 5)) {
            return;
        }

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey($request, $guard)),
            ]),
        ]);
    }

    protected function throttleKey(Request $request, $guard)
    {
        return strtolower($request->input('email')) . '|' . $guard . '|' . $request->ip();
    }
}