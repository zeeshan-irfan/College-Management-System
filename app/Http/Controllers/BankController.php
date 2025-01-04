<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    public function index()
    {
        $banks=Bank::orderBy('name','asc')->paginate(10);
        return view('admin.bank',compact('banks'));
    }



    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:banks,name',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Ensure it's a valid image file
            'account' => 'required|string|max:30|unique:banks,account',
        ]);

        // Prepare data for insertion
        $bankData = [
            'name' => $validated['name'],
            'account' => $validated['account'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($request->hasFile('logo')) {
            // Generate a unique filename
            $logoFile = $request->file('logo');
            $uniqueName = str_replace(' ', '', $bankData['name']) . '.' . $logoFile->getClientOriginalExtension();

            // Store the logo in the specified folder
            $logoPath = $logoFile->storeAs('images/logo', $uniqueName, 'public');

            // Add logo path to bank data
            $bankData['logo'] = $logoPath;
        }

        try {
            // Insert the bank data into the database
            DB::transaction(function () use ($bankData) {
                DB::table('banks')->insert($bankData);
            });

            // Redirect to success page
            return redirect()->route('bank.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Bank Created!',
                'alertMessage' => 'The bank has been created successfully.',
            ]);
        } catch (\Exception $e) {
            // Rollback if an error occurs
            if (isset($logoPath) && Storage::exists('public/' . $logoPath)) {
                Storage::delete('public/' . $logoPath); // Delete the uploaded file on failure
            }

            // Return with an error message
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Create Bank!',
                'alertMessage' => 'An error occurred while creating the bank. Please try again.',
            ])->withInput();
        }
    }

    public function edit($id)
    {
        try {
            // Find the bank by ID
            $bank = DB::table('banks')->where('id', $id)->first();

            // Check if the bank exists
            if (!$bank) {
                throw new \Exception('Bank not found.');
            }

            // Pass the bank data to the edit view
            return view('admin.edit-bank', compact('bank'));
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->route('bank.index')->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Load Edit Form!',
                'alertMessage' => $e->getMessage() ?: 'An error occurred while trying to edit the bank. Please try again.',
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:banks,name,' . $id,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Ensure valid image
            'account' => 'required|string|max:30|unique:banks,account,' . $id,
        ]);

        try {
            // Start a transaction
            DB::transaction(function () use ($validated, $id, $request) {
                // Find the bank
                $bank = DB::table('banks')->where('id', $id)->lockForUpdate()->first();
                if (!$bank) {
                    throw new \Exception('Bank not found.');
                }

                // Prepare updated data
                $updatedData = [
                    'name' => $validated['name'],
                    'account' => $validated['account'],
                    'updated_at' => now(),
                ];

                // Handle logo update
                if ($request->hasFile('logo')) {
                    // Generate a unique filename
                    $logoFile = $request->file('logo');
                    $uniqueName = 'bank'.$id.'.' . $logoFile->getClientOriginalExtension();

                    // Store the new logo
                    $newLogoPath = $logoFile->storeAs('images/logo', $uniqueName, 'public');

                    // Delete the old logo if it exists
                    if ($bank->logo && Storage::disk('public')->exists($bank->logo)) {
                        Storage::disk('public')->delete($bank->logo);
                    }

                    $updatedData['logo'] = $newLogoPath;
                }

                // Update the bank data in the database
                DB::table('banks')->where('id', $id)->update($updatedData);
            });

            // Redirect with success message
            return redirect()->route('bank.index')->with([
                'alertType' => 'success',
                'alertReason' => 'Bank Updated!',
                'alertMessage' => 'The bank details have been updated successfully.',
            ]);
        } catch (\Exception $e) {
            // Handle errors
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Failed to Update Bank!',
                'alertMessage' => $e->getMessage() ?: 'An error occurred while updating the bank. Please try again.',
            ])->withInput();
        }
    }





}
