<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        try {
            $request->authenticate(); // Authenticate user
            $request->session()->regenerate(); // Regenerate session to prevent session fixation attacks

            // Check if the authenticated user has a role
            $user = Auth::user();
            if (!$user || !$user->roles->first()->name) {
                throw new \Exception('User role is not defined.');
            }

            // Redirect based on the role
            switch ($user->roles->first()->name) {
                case 'admin':
                    return redirect()->route('admin.home');
                // case 'student':
                //     return redirect()->route('user.home');
                // case 'faculty':
                //     return redirect()->route('faculty.dashboard');
                // case 'hod':
                //     return redirect()->route('hod.dashboard');
                // case 'clerk':
                //     return redirect()->route('clerk.dashboard');
                case 'user':
                    return redirect()->route('user.home');
                default:
                return redirect()->route('login')->withErrors([
                    'login' => 'An error occurred while logging in.',
                ]);
            }
        } catch (\Exception $e) {
            // Log the error for debugging

            Log::error('Login error: ' . $e->getMessage(), [
                'user_id' => $user->id ?? 'N/A',
                'email' => $user->email ?? $request->input('email'),
            ]);

            // Redirect back with an error message
            return redirect()->route('login')->withErrors([
                'password' =>$e->getMessage(),
            ]);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
