<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


public function store(Request $request): RedirectResponse
{
    // Validate the incoming request data
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    DB::beginTransaction();

    try {
        // Create the user with hashed password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the default role to the new user
        $user->roles()->attach(1); // Ensure role ID 1 exists in roles table

        // If both user creation and role assignment are successful, commit the transaction
        DB::commit();

        // Trigger the Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        // Redirect to the dashboard , according to role
        if(Auth::user()->roles->first()->name == "admin" )
        {
            return redirect()->route('admin.home');
        }

        return redirect()->route('user.home');

    } catch (\Throwable $th) {
        // Rollback the transaction if there was an error
        DB::rollBack();

        // Log the error and redirect back with an error message
        Log::error("Failed to register user or assign role: {$th->getMessage()}");
        return back()->withErrors(['name' => 'There was an error registering the user. Please try again later.']);
    }
}



}
