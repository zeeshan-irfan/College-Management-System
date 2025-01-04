<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function updatePersonalInfo(Request $request)
    {
    // Validation with custom attribute names
        $request->validate([
            'cnic' => 'required|digits:13|unique:personals,cnic,' . Auth::id() . ',user_id',
            'nationality' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required|date',
            'pob' => 'required|string|max:255',
            'domicileDist' => 'required|string|max:255',
            'domicileProvince' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'contact' => 'required|regex:/^\+?[0-9]{10,15}$/',
        ], [], [
            // Custom attribute names
            'cnic' => 'CNIC',
            'nationality' => 'Nationality',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'pob' => 'Place of Birth',
            'domicileDist' => 'Domicile District',
            'domicileProvince' => 'Domicile Province',
            'religion' => 'Religion',
            'contact' => 'Cell No',
        ]);

        try {
            // Update or Create Personal Information
            $user = User::find(Auth::id());
    
            $user->personalinfo()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'cnic' => $request->cnic,
                    'nationality' => $request->nationality,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'pob' => $request->pob,
                    'domicileDist' => $request->domicileDist,
                    'domicileProvince' => $request->domicileProvince,
                    'religion' => $request->religion,
                    'contact' => $request->contact,
                ]
            );
    
            // Redirect with success message
            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'Personal Information Successfully Updated.'
            ]);
    
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Action Failed!',
                'alertMessage' => 'An error occurred while updating your personal information. Please try again later.',
            ])->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function updateHafizInfo(Request $request)
    {
        // Validate the hafiz field
        $request->validate([
            'hafiz' => 'required|in:no,yes',
        ], [], [
            'hafiz' => 'Hafiz',  // Custom attribute name for error messages
        ]);
    
        try {
            // Find the user's personal info entry
            $user = User::find(Auth::id());
            $personalInfo = $user->personalinfo;
    
            // Check if personal info exists for the user
            if ($personalInfo) {
                // Update the hafiz field if personal info exists
                $personalInfo->update([
                    'hafiz' => $request->hafiz,
                ]);
    
                // Redirect with success message
                return redirect()->back()->with([
                    'alertType' => 'success',
                    'alertReason' => 'Action Successful!',
                    'alertMessage' => 'Information successfully updated.'
                ]);
            } else {
                // Return with error if no personal info entry exists
                return redirect()->back()->with([
                    'alertType' => 'danger',
                    'alertReason' => 'Action Failed!',
                    'alertMessage' => 'Something went wrong, please try later.'
                ]);
            }
            
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Action Failed!',
                'alertMessage' => 'An error occurred while updating Information. Please try again later.',
            ])->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateDisableInfo(Request $request)
{
    // Validate the disabled field
    $request->validate([
        'disabled' => 'required|in:no,yes',
    ], [], [
        'disabled' => 'Disabled Status',  // Custom attribute name for error messages
    ]);

    try {
        // Find the user's personal info entry
        $user = User::find(Auth::id());
        $personalInfo = $user->personalinfo;

        // Check if personal info exists for the user
        if ($personalInfo) {
            // Update the disabled field if personal info exists
            $personalInfo->update([
                'disabled' => $request->disabled,
            ]);

            // Redirect with success message
            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'Disabled status successfully updated.'
            ]);
        } else {
            // Return with error if no personal info entry exists
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Action Failed!',
                'alertMessage' => 'Something went wrong, please try later.'
            ]);
        }
        
    } catch (\Exception $e) {
        // Handle any unexpected errors
        return redirect()->back()->with([
            'alertType' => 'danger',
            'alertReason' => 'Action Failed!',
            'alertMessage' => 'An error occurred while updating disabled status. Please try again later.',
        ])->withErrors(['error' => $e->getMessage()]);
    }
}

    


}
