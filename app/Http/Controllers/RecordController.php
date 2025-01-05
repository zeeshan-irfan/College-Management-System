<?php

namespace App\Http\Controllers;
use App\Models\Record;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    public function applied()
    {
        $records = Auth::user()->records()->orderBy('created_at', 'asc')->get();
        return view('user.applied', compact('records'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'admission' => 'required|exists:admissions,id',
            'program' => 'required|exists:programs,id',
        ]);

        // Adjust column names to match the database
        $validated['admission_id'] = $validated['admission'];
        $validated['program_id'] = $validated['program'];
        $validated['user_id'] = Auth::id();
        unset($validated['admission'], $validated['program']); // Remove unnecessary keys

        // Add timestamps
        $currentTimestamp = now();
        $validated['created_at'] = $currentTimestamp;
        $validated['updated_at'] = $currentTimestamp;

        try {
            // Use a transaction for both admission and challan operations
            DB::transaction(function () use ($validated, $currentTimestamp) {
                // Check if the combination already exists
                $exists = DB::table('records')
                    ->where('user_id', $validated['user_id'])
                    ->where('admission_id', $validated['admission_id'])
                    ->where('program_id', $validated['program_id'])
                    ->lockForUpdate() // Prevent race conditions
                    ->exists();

                if ($exists) {
                    throw new Exception('Duplicate Entry');
                }

                // Insert the validated admission data
                $recordId = DB::table('records')->insertGetId($validated);

                // Fetch the fee from the related admission
                $admission = DB::table('admissions')->where('id', $validated['admission_id'])->first();
                if (!$admission || !isset($admission->challan_fee)) {
                    throw new Exception('Challan Fee Not Found');
                }
                $fee = $admission->challan_fee;

                // Generate a unique 10-digit challan number
                do {
                    $challanNumber = mt_rand(1000000000, 9999999999); // 10-digit range
                } while (DB::table('challans')->where('challan_no', $challanNumber)->exists());

                // Prepare challan data
                $challanData = [
                    'challan_no' => $challanNumber,
                    'user_id' => $validated['user_id'],
                    'record_id' => $recordId,
                    'fee' => $fee, // Dynamically fetched fee
                    'status' => 'pending', // Default status
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ];

                // Insert challan into the database
                $challanInserted = DB::table('challans')->insert($challanData);

                // If challan creation fails, throw an exception to trigger rollback
                if (!$challanInserted) {
                    throw new Exception('Challan Generation Failed');
                }
            });

            return redirect()->route('user.applied')->with([
                'alertType' => 'success',
                'alertReason' => 'Admission Applied!',
                'alertMessage' => 'The Admission has been applied successfully, and a challan has been generated.',
            ]);

        } catch (Exception $e) {
            $errorMessage = match ($e->getMessage()) {
                'Duplicate Entry' => 'You have already applied in this Program.',
                'Challan Fee Not Found' => 'Unable to fetch challan fee. Please contact support.',
                default => 'An unknown error occurred. Please try again later.',
            };

            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Apply!',
                'alertMessage' => $errorMessage,
            ])->withInput();
        }
    }

    public function applications()
    {
        try {

            $records = Record::with([
                'user.personalinfo',
                'user.fatherinfo',
                'user.address',
                'user.matriceducation',
                'user.intereducation',
                'user.baeducation',
                'user.bseducation',
                'challan',
                'program',
                'admission'
            ])->orderBy('created_at', 'asc')->paginate(50);
            return view('admin.applications', compact('records'));
        } catch (\Exception $e) {
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Error',
                'alertMessage' => 'Unable to retrieve records: ' . $e->getMessage(),
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

        // Fetch records with prioritized matches based on user name or email
        $records = Record::with([
            'user.personalinfo',
            'user.fatherinfo',
            'user.address',
            'user.matriceducation',
            'user.intereducation',
            'user.baeducation',
            'user.bseducation',
            'challan',
            'program',
            'admission',
        ])
        ->join('users', 'records.user_id', '=', 'users.id') // Join the users table
        ->where(function ($query) use ($search) {
            $query->where('users.name', 'like', "%{$search}%")
                ->orWhere('users.email', 'like', "%{$search}%");
        })
        ->orderByRaw("
            CASE
                WHEN users.name LIKE ? THEN 1
                WHEN users.email LIKE ? THEN 1
                ELSE 2
            END
        ", ["%{$search}%", "%{$search}%"]) // Prioritize records with matching user name or email
        ->orderBy('records.created_at', 'desc') // Secondary sorting by creation date
        ->select('records.*') // Ensure only records columns are selected
        ->paginate(10); // Paginate the results

        // Return the view with the search results
        return view('admin.applications', compact('records'));
    }


    public function destroy($id)
    {
        try {
            // Find the record by ID
            $record = Record::findOrFail($id);

            // Delete the record
            $record->delete();

            // Redirect back with success message
            return redirect()->route('records.applicants')->with([
                'alertType' => 'success',
                'alertReason' => 'Record Deleted!',
                'alertMessage' => 'The record has been successfully deleted.',
            ]);
        } catch (ModelNotFoundException $e) {
            // Handle case where record is not found
            return redirect()->route('records.applicants')->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested record does not exist.',
            ]);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->route('records.applicants')->with([
                'alertType' => 'danger',
                'alertReason' => 'Error!',
                'alertMessage' => 'An unexpected error occurred while deleting the record.',
            ]);
        }
    }



}
