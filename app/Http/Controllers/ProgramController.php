<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Log;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('department')
            ->orderBy(Department::select('name')->whereColumn('id', 'programs.department_id'), 'asc')
            ->paginate(10); // You can adjust the pagination limit
        $departments = Department::orderBy('name', 'asc')->get();
        return view('admin.program', compact('programs','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return redirect()->route('program.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'department' => 'required|exists:departments,id',
            'name' => 'required|string|unique:programs,name|max:255'
        ], [
            'department.exists' => 'The selected department does not exist.',
            'name.unique' => 'This program already exists.',
        ]);

        // return $validated;

        try {
            // Store the validated data in the database
            Program::create([
                'department_id' => $validated['department'],
                'name' => $validated['name'],
            ]);

            return redirect()->route('program.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Program Created!',
                'alertMessage' => 'Program was created successfully.',
            ]);
        } catch (Exception $e) {
            Log::error('An error occurred while creating the record: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with([
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
        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested program does not exist.',
            ]);
        }

        return view('admin.program.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested program does not exist.',
            ]);
        }

        $departments = Department::all(); // Get all departments for the program edit form
        return view('admin.edit-program', compact('program', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $request->validate([
            'department' => 'required|exists:departments,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('programs')->ignore($id), // Ensure uniqueness, ignoring the current program
            ],
            'status' => 'required|boolean',
        ]);

        // Find the program
        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested program does not exist.',
            ]);
        }

        try {
            // Update the program
            $program->update([
                'department_id' => $request->department,
                'name' => $request->name,
                'status' => $request->status,
            ]);

            return redirect()->route('program.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Updated!',
                'alertMessage' => 'Program updated successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while updating the program. Please try again.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested program does not exist.',
            ]);
        }

        try {
            $program->delete();

            return redirect()->route('program.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Deleted!',
                'alertMessage' => 'Program deleted successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->route('program.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while deleting the program.',
            ]);
        }
    }
}
