<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degrees=Degree::orderBy('type','asc')->paginate(10);
        return view('admin.degree',compact('degrees'));
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
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:degrees,name',
            'type' => 'required|in:matric,intermediate,ba,ma',
        ]);

        try {
            // Store the validated data in the database
            Degree::create([
                'name' => $validated['name'],
                'type' => $validated['type'],
            ]);

            return redirect()->route('degree.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Degree Created!',
                'alertMessage' => 'The degree was created successfully.',
            ]);

        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('An error occurred while creating the degree: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with error message and input data
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Create Degree!',
                'alertMessage' => 'An error occurred while creating the degree. Please try again later.',
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
        $degree = Degree::find($id);

            if (!$degree) {
                // Redirect to the degree index if the degree is not found
                return redirect()->route('degree.index')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Not Found!',
                    'alertMessage' => 'The requested degree does not exist.',
                ]);
            }

            return view('admin.edit-degree', compact('degree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('degrees')->ignore($id), // Ensure the name is unique but ignore the current degree
            ],
            'type' => 'required|in:matric,intermediate,ba,ma', // Validate the type
            'status' => 'required|boolean', // Validate the status (active or inactive)
        ], [
            'name.unique' => 'This degree name is already in use.',
            'status.boolean' => 'Status must be either active or inactive.',
        ]);

        try {
            // Find the degree by its ID
            $degree = Degree::find($id);

            if (!$degree) {
                // If the degree doesn't exist, redirect with an error message
                return redirect()->route('degree.index')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Not Found!',
                    'alertMessage' => 'The requested degree does not exist.',
                ]);
            }

            // Update the degree record
            $degree->update([
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status,
            ]);

            // Redirect back with a success message
            return redirect()->route('degree.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Updated!',
                'alertMessage' => 'Degree updated successfully.',
            ]);
        } catch (Exception $e) {
            // Handle any exception that occurs during the update
            return redirect()->route('degree.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while updating the degree. Please try again.',
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the degree by ID
            $degree = Degree::findOrFail($id);

            // Delete the degree
            $degree->delete();

            // Redirect with a success message
            return redirect()->route('degree.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Degree Deleted!',
                'alertMessage' => 'The degree was deleted successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            // Handle case when the degree is not found
            return redirect()->route('degree.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested degree does not exist.',
            ]);
        } catch (Exception $e) {
            // Log any other errors
            Log::error('An error occurred while deleting the degree: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect with an error message
            return redirect()->route('degree.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Delete!',
                'alertMessage' => 'An unknown error occurred. Please try again later.',
            ]);
        }
    }

    public function linkpage($id)
    {
        // Find the degree or return 404 if not found
        $degree = Degree::with('programs')->find($id);
        if (!$degree||$degree->type=="Matric or Equivalent") {
            return redirect()->route('degree.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested degree does not exist.',
            ]);
        }

        // Retrieve all programs ordered by type
        $programs = Program::orderBy('name', 'asc')->get();

        // Pass the data to the view
        return view('admin.degree-linking', compact('degree', 'programs'));
    }


    public function link(Request $request,$id)
    {

        // Validate the incoming request
        $validatedData = $request->validate([
            'programs' => ['array'], // Ensure programs is an array
            'programs.*' => ['integer', 'exists:programs,id'], // Each program ID must exist in the programs table
        ], [
            'programs.array' => 'Programs must be an array of IDs.',
            'programs.*.exists' => 'One or more selected programs are invalid.',
        ]);

        try {
            // Find the degree
            $degree = Degree::findOrFail($id);

            // Sync programs to the degree
            DB::transaction(function () use ($degree, $validatedData) {
                $degree->programs()->sync($validatedData['programs'] ?? []);
            });

            // Redirect with success message
            return redirect()->route('degree.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Updated Successfully!',
                'alertMessage' => 'Programs have been successfully linked to the degree.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            // Handle general exceptions
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error Occurred!',
                'alertMessage' => 'Failed to link programs. Please try again.',
            ])->withInput();
        }
    }

}
