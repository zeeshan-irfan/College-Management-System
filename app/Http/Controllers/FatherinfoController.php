<?php
namespace App\Http\Controllers;

use App\Models\Fatherinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FatherinfoController extends Controller
{
    public function updatefatherInfo(Request $request)
    {
        // Define custom attribute names for error messages
        $attributeNames = [
            'fname' => 'Father Name',
            'gname' => 'Guardian Name',
            'grelation' => 'Guardian Relation',
            'fcnic' => 'Father/Guardian CNIC',
            'income' => 'Annual Income',
        ];

        // Validate input data with custom attribute names
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'gname' => 'nullable|string|max:255',
            'grelation' => 'nullable|string|max:255',
            'fcnic' => 'required|digits:13',
            'income' => 'required|numeric|min:0',
        ], [], $attributeNames);

        try {
            // Use updateOrCreate to update existing fatherinfo or create a new one
            Fatherinfo::updateOrCreate(
                ['user_id' => Auth::id()], // Matching criteria for the one-to-one relationship
                $validatedData // Fields to update or insert
            );

            // Redirect back with a success message
            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'Father/Guardian information updated successfully.'
            ]);

        } catch (\Exception $e) {
            // Handle unexpected errors
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Action Failed!',
                'alertMessage' => 'An error occurred while updating the information. Please try again later.',
            ])->withErrors(['error' => $e->getMessage()]);
        }
    }
}
