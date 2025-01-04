<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function updateNameImage(Request $request)
    {
       // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024', // 1MB max
        ]);


        $user = user::find(Auth::id());

        // Update the user’s name
        $user->update([
            'name' => $request->input('name')
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Generate a unique name for the file
            $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

            // Define the file path with the unique name
            $filePath = $file->storeAs('images/profile', $uniqueFileName, 'public');

            // Delete the previous image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image->path);
            }

            // Use updateOrCreate to either update an existing image record or create a new one
            $user->image()->updateOrCreate(
                [], // No condition, as we only want one image per user
                ['path' => $filePath]
            );
        }

        return redirect()->back()->with([
            'alertType'=>'success',
            'alertReason'=>'Action Successful!',
            'alertMessage'=>'Upated your records'
        ]);

    }
}
