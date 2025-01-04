<?php

namespace App\Http\Controllers;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        $members = About::all();
        if (Auth::user()->roles->first()->name =='admin') {
            return view('admin.about',compact('members'));
        } else {
            return view('user.about',compact('members'));
        }


    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024', // 1MB max
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'nullable|email',
            'role' => 'required|string', // Valid roles
            'description' => 'required|string', // Valid description
            'profile' => 'nullable|url', // Valid URL
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
            // Create a new About instance
            $about = About::create([
                'name' => $request->input('name'),
                'designation' => $request->input('designation'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'description' => $request->input('description'),
                'profile' => $request->input('profile'),
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Generate a unique name for the file
                $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

                // Define the file path with the unique name
                $filePath = $file->storeAs('images/profile', $uniqueFileName, 'public');

                // Save the image path in the database
                $about->image = $filePath;
                $about->save(); // Save the path in the database
            }

            // Commit the transaction if all steps succeed
            DB::commit();

            // Redirect to the list of abouts with a success message
            return redirect()->route('admin.about')->with([
                'alertType' => 'success',
                'alertReason' => 'Member Created',
                'alertMessage' => 'The member entry was successfully created.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any step fails
            DB::rollBack();

            // Log the error for debugging purposes
            Log::error('Error creating about', [
                'exception' => $e,
                'user_input' => $request->all(),
            ]);

            // Catch any errors and return with an error message
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while creating the member entry. Please try again.',
            ])->withInput();
        }
    }

    public function edit($id)
    {
        $about=About::find($id);
        if (!$about) {
            return redirect()->route('admin.about')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'This entry does not exist.',
            ])->withInput();
        }

        return view('admin.edit-about',compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::find($id);

        if (!$about) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'This entry does not exist.',
            ])->withInput();
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024', // 1MB max
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'nullable|email',
            'role' => 'required|string',
            'description' => 'required|string',
            'profile' => 'required|url',
        ]);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Update the `About` instance
            $about->update([
                'name' => $validated['name'],
                'designation' => $validated['designation'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'description' => $validated['description'],
                'profile' => $validated['profile'],
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete the existing image if it exists
                if ($about->image && Storage::disk('public')->exists($about->image)) {
                    Storage::disk('public')->delete($about->image);
                }

                $file = $request->file('image');

                // Generate a unique name and store the file
                $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('images/profile', $uniqueFileName, 'public');

                // Save the new file path
                $about->image = $filePath;
                $about->save();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('admin.about')->with([
                'alertType' => 'success',
                'alertReason' => 'Member Updated',
                'alertMessage' => 'The member entry was successfully updated.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            Log::error('Error updating about entry', [
                'exception' => $e,
                'user_input' => $request->all(),
            ]);

            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while updating the member entry. Please try again.',
            ])->withInput();
        }
    }

    public function destroy(string $id)
    {
        // Begin database transaction
        DB::beginTransaction();

        try {
            // Find the about by ID
            $about = About::findOrFail($id);

            // Check if the about has an associated image
            if ($about->image) {

                if (Storage::disk('public')->exists($about->image)) {
                    Storage::disk('public')->delete($about->image);;
                }
            }

            // Delete the about
            $about->delete();

            // Commit the transaction
            DB::commit();

            // Redirect with a success message
            return redirect()->route('admin.about')->with([
                'alertType' => 'success',
                'alertReason' => 'Member Deleted',
                'alertMessage' => 'The Member been successfully deleted.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error deleting about', [
                'exception' => $e,
                'about_id' => $id,
            ]);

            // Redirect with an error message
            return redirect()->route('admin.about')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'An error occurred while deleting the Member. Please try again.',
            ]);
        }
    }

}
