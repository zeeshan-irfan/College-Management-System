<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.department');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.department');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|unique:departments,name|max:255',
        ],[
            'unique'=>'This Department already exists.'
        ],[]);

        try {
            // Store the validated data in the database
            $department = Department::create([
                'name' => $validated['name'],
                'status' => true, // Default value for status
            ]);

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Department Created!',
                'alertMessage' => 'Department is created successfully.',
            ]);

        } catch (\Exception $e) {
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to create!',
                'alertMessage' => 'Unknown error occurred! Please try again later.',
            ])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.department');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);

            if (!$department) {
                // Redirect to the department index if the department is not found
                return redirect()->route('department.index')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Not Found!',
                    'alertMessage' => 'The requested department does not exist.',
                ]);
            }

            return view('admin.edit-department', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

            // Validate the incoming data
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('departments')->ignore($id), // Ensure uniqueness, ignoring the current department
                ],
                'status' => 'required|boolean',
            ]);


            // Find the department
            $department = Department::find($id);

            if (!$department) {
                return redirect()->route('department.index')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Not Found!',
                    'alertMessage' => 'The requested department does not exist.',
                ]);
            }

            try {
            // Update the department
            $department->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            return redirect()->route('department.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Updated!',
                'alertMessage' => 'Department updated successfully.',
            ]);

        } catch (Exception $e) {
            // If an error occurs, return a generic error message
            return redirect()->route('department.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while updating the department. Please try again.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return redirect()->route('department.index')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Not Found!',
                    'alertMessage' => 'The requested department does not exist.',
                ]);
            }

            $department->delete();

            return redirect()->route('department.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Deleted!',
                'alertMessage' => 'Department deleted successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->route('department.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while deleting the department.',
            ]);
        }
    }
}
