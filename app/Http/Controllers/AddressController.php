<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function updateAddress(Request $request)
{
    // Validate the form data
    $request->validate([
        'line' => 'required|string|max:65535',
        'city' => 'required|string|max:100',
        'province' => 'required|string|max:100',
        'country' => 'required|string|max:100',
        'contact' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
    ]);

    try {
        $user = User::find(Auth::id());

        // If the user is not found
        if (!$user) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Address Update Failed!',
                'alertMessage' => 'Please refresh the page and try again.',
            ]);
        }

        // Update or create the user's address
        $user->address()->updateOrCreate(
            [], // Only one address per user
            [
                'line' => $request->input('line'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'country' => $request->input('country'),
                'contact' => $request->input('contact'),
            ]
        );

        return redirect()->back()->with([
            'alertType' => 'success',
            'alertReason' => 'Action Successful!',
            'alertMessage' => 'Address updated successfully.',
        ]);
    } catch (\Exception $e) {
        // Handle unexpected errors
        return redirect()->back()->with([
            'alertType' => 'danger',
            'alertReason' => 'Action Failed!',
            'alertMessage' => 'An error occurred while updating the address. Please try again later.',
        ])->withErrors(['error' => $e->getMessage()]);
    }
}

}
