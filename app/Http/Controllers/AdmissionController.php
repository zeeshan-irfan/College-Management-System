<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Bank;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = Admission::latest()->paginate(10);
        $banks = Bank::all();
        return view('admin.admission', compact(['admissions','banks']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'semester' => 'required|in:fall,spring,summer',
            'batch' => 'required|string|unique:admissions,batch|max:255',
            'last_date' => 'required|date|after:today',  // Ensure last_date is a future date
            'bank_id' => 'required|exists:banks,id',      // Ensure bank_id is valid
            'challan_fee' => 'required|numeric|min:0',    // Challan fee must be a positive number
            'challan_last_date' => 'required|date|after:last_date', // Challan last date should be after last date
        ], [
            'unique' => 'An admission entry for this batch already exists.',
            'last_date.after' => 'The last date to apply must be a future date.',
            'challan_last_date.after' => 'The challan last date must be after the last date to apply.',
            'challan_fee.numeric' => 'The challan fee must be a valid number.',
            'challan_fee.min' => 'The challan fee must be at least 0.',
        ]);

        try {
            // Store the validated data in the database
            Admission::create([
                'semester' => $validated['semester'],
                'batch' => $validated['batch'],
                'last_date' => $validated['last_date'],
                'bank_id' => $validated['bank_id'],
                'challan_fee' => $validated['challan_fee'],
                'challan_last_date' => $validated['challan_last_date'],
            ]);

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Admission Created!',
                'alertMessage' => 'Admission is created successfully.',
            ]);
        } catch (Exception $e) {
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to create!',
                'alertMessage' => 'An unknown error occurred. Please try again later.',
            ])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admission = Admission::find($id);

        if (!$admission) {
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested admission does not exist.',
            ]);
        }

        return view('admin.admission', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the admission record based on the provided ID
        $admission = Admission::find($id);
        $banks = Bank::all();

        if (!$admission) {
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested admission does not exist.',
            ]);
        }

        // Return the edit view with the admission and bank data
        return view('admin.edit-admission', compact('admission', 'banks'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input
        $validated = $request->validate([
            'semester' => 'required|in:fall,spring,summer',
            'batch' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admissions')->ignore($id),
            ],
            'last_date' => 'required|date|after_or_equal:today',
            'challan_fee' => 'required|numeric|min:1',
            'challan_last_date' => 'required|date|after_or_equal:today',
            'bank_id' => 'required|exists:banks,id',
            'status' => 'required|boolean',
        ]);

        // Find the admission record by ID
        $admission = Admission::find($id);

        // Check if the admission exists
        if (!$admission) {
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested admission does not exist.',
            ]);
        }

        try {
            // Update the admission record
            $admission->update([
                'semester' => $validated['semester'],
                'batch' => $validated['batch'],
                'last_date' => $validated['last_date'],
                'challan_fee' => $validated['challan_fee'],
                'challan_last_date' => $validated['challan_last_date'],
                'bank_id' => $validated['bank_id'],
                'status' => $validated['status'],
            ]);

            return redirect()->route('admission.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Updated!',
                'alertMessage' => 'Admission updated successfully.',
            ]);
        } catch (Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while updating the admission. Please try again.',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admission = Admission::find($id);

        if (!$admission) {
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested admission does not exist.',
            ]);
        }

        try {
            $admission->delete();

            return redirect()->route('admission.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Deleted!',
                'alertMessage' => 'Admission deleted successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->route('admission.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An error occurred while deleting the admission. Please try again.',
            ]);
        }
    }

    public function UserProfilePercentage()
    {
        $user = Auth::user();

        // If no authenticated user, return 0%
        if (!$user) {
            return 0;
        }

        // Weightages for each profile section
        $weightages = [
            'personalinfo' => 10,
            'image' => 10,
            'fatherinfo' => 10,
            'address' => 10,
            'matriceducation' => 15,
            'intereducation' => 15,
            'baeducation' => 10,
            'bseducation' => 10,
        ];

        // Calculate profile completion percentage
        $count = 10; // Base score
        foreach ($weightages as $relation => $weight) {
            $count += optional($user->$relation)->exists() ? $weight : 0;
        }


        // Ensure count does not exceed 100%
        return min($count, 100);
    }

    public function apply()
    {
        // Define minimum profile completion percentage as a constant
        $minimumCompletion = 70;

        try {
            // Check if the user's profile completion percentage meets the requirement
            if ($this->UserProfilePercentage() >= $minimumCompletion) {
                $user = Auth::user();

                $degrees = []; // Initialize as an empty array

                $educationRelations = ['intereducation', 'baeducation', 'bseducation'];

                foreach ($educationRelations as $relation) {
                    if ($user->$relation) { // Check if the relation exists
                        $degrees[] = $user->$relation->degree_id; // Add degree_id to the array
                    }
                }



                $admissions = Admission::where(['status'=> true])->get();

                $programs = Program::where('status', true)
                   ->whereHas('degrees', function ($query) use ($degrees) {
                       $query->whereIn('degrees.id', $degrees);
                   })->get();


                // Redirect back if there are no active admissions or programs
                if ($admissions->isEmpty() || $programs->isEmpty()) {
                    return redirect()->back()->with([
                        'alertType' => 'warning',
                        'alertReason' => 'Unavailable Resources!',
                        'alertMessage' => 'No active admissions or programs available at the moment.',
                    ]);
                }
                // return compact('admissions', 'programs');

                // Render the application view
                return view('user.apply', compact('admissions', 'programs'));
            } else {
                // Redirect if profile percentage is below the required threshold
                return redirect()->route('user.profile')->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Profile Incomplete!',
                    'alertMessage' => 'Please complete your profile to at least 70% before applying.',
                ]);
            }
        } catch (\Exception $e) {
            // Handle unexpected errors gracefully
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Unexpected Error!',
                'alertMessage' => 'An error occurred while processing your request. Please try again later.',
            ]);
        }
    }


}

