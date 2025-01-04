<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user has any of the allowed roles
        $user = Auth::user();
        if ($user->roles->isEmpty() || !$user->roles->pluck('name')->intersect($roles)->isNotEmpty()) {
            // Redirect if the user does not have any of the specified roles
            return redirect('/unauthorized');
        }

        return $next($request); // Continue to the next middleware or request
    }
}
