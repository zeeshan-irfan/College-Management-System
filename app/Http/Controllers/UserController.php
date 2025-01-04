<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            // Fetch users excluding the current authenticated user
            $users = User::select('id', 'name', 'email', 'created_at') // Select only required columns
                ->where('id', '!=', Auth::id()) // Exclude the currently authenticated user
                ->orderBy('created_at', 'desc') // Order by latest created users
                ->paginate(10); // Paginate results

            // Pass users to the view
            return view('admin.user', compact('users'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error fetching users for index', [
                'exception' => $e,
            ]);

            // Redirect with an error message
            return redirect()->route('dashboard')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while fetching the user list. Please try again.',
            ]);
        }
    }


    public function search(Request $request)
    {
        // Validate the search input
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        // Get the search query
        $search = $request->input('search');

        // Fetch all users but prioritize matches
        $users = User::select('id', 'name', 'email', 'created_at') // Fetch only required fields
                    ->orderByRaw("
                        CASE
                            WHEN name LIKE ? THEN 1
                            WHEN email LIKE ? THEN 1
                            ELSE 2
                        END
                    ", ["%{$search}%", "%{$search}%"]) // Prioritize search matches
                    ->orderBy('created_at', 'desc') // Secondary sort for all users
                    ->paginate(10); // Paginate the results

        // Return the view with the results
        return view('admin.user', compact('users'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:1,2,3,4,5,6', // Valid roles
        ]);

        // If validation fails, return the errors to the form
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new user using Eloquent
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // Hash the password
            ]);

            // Assign the selected role to the user using Eloquent
            $user->roles()->sync($request->input('role'));

            // Commit the transaction if all steps succeed
            DB::commit();

            // Redirect to the list of users with a success message
            return redirect()->route('user.index')->with([
                'alertType' => 'success',
                'alertReason' => 'User Created',
                'alertMessage' => 'The user was successfully created.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any step fails
            DB::rollBack();

            // Log the error for debugging purposes
            Log::error('Error creating user', [
                'exception' => $e,
                'user_input' => $request->all(),
            ]);

            // Catch any errors and return with an error message
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while creating the user. Please try again.',
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        try {
            // Find the user by ID or fail gracefully
            $user = User::findOrFail($id);
            // Return the edit user view with the user data
            return view('admin.edit-user', compact('user'));

        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error during user edit', [
                'userId' => $id,
                'exception' => $e,
            ]);

            // Redirect with a generic error message
            return redirect()->route('user.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An unexpected error occurred. Please try again.',
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore unique check for the current user
            'role' => 'required|in:1,2,3,4,5,6', // Valid roles
        ]);

        // If validation fails, return the errors to the form
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the user's basic information
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            // Save the updated user information
            $user->save();

            // Assign the selected role to the user
            $user->roles()->sync($request->input('role'));

            // Commit the transaction if all steps succeed
            DB::commit();

            // Redirect to the list of users with a success message
            return redirect()->route('user.index')->with([
                'alertType' => 'success',
                'alertReason' => 'User Updated',
                'alertMessage' => 'The user was successfully updated.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any step fails
            DB::rollBack();

            // Log the error for debugging purposes
            Log::error('Error updating user', [
                'exception' => $e,
            ]);

            // Return with an error message
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while updating the user. Please try again.',
            ])->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Begin database transaction
        DB::beginTransaction();

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Check if the user has an associated image
            if ($user->image) {

                if (Storage::disk('public')->exists($user->image->path)) {
                    Storage::disk('public')->delete($user->image->path);;
                }

                // Delete the image record from the database
                $user->image->delete();
            }

            // Delete the user
            $user->delete();

            // Commit the transaction
            DB::commit();

            // Redirect with a success message
            return redirect()->route('user.index')->with([
                'alertType' => 'success',
                'alertReason' => 'User Deleted',
                'alertMessage' => 'The user and their image have been successfully deleted.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error deleting user', [
                'exception' => $e,
                'user_id' => $id,
            ]);

            // Redirect with an error message
            return redirect()->route('user.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while deleting the user. Please try again.',
            ]);
        }
    }


}
