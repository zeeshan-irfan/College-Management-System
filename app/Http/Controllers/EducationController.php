<?php

namespace App\Http\Controllers;

use App\Models\Baeducation;
use App\Models\Bseducation;
use App\Models\Intereducation;
use App\Models\Matriceducation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{

    public function updateMatricEducation(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'mdegree' => 'required|exists:degrees,id',
            'mboard' => 'required|string|max:100',
            'minstitute' => 'required|string|max:255',
            'myear' => 'required|integer|min:1900|max:2080',
            'mexam' => 'required|string|in:Annual,Supplementary',
            'mroll' => 'required|string|max:100',
            'mtotal' => 'required|integer|min:1',
            'mobtained' => 'required|integer|min:0|max:' . $request->input('mtotal'),
            'mpercent' => 'required|numeric|min:0|max:100',
            'mgrade' => 'required|string|in:A,B,C,D,E,F',
        ], [], [
            'mdegree' => 'Degree',
            'mboard' => 'Board',
            'minstitute' => 'Name of Institution',
            'myear' => 'Passing Year',
            'mexam' => 'Exam Type',
            'mroll' => 'Roll Number',
            'mtotal' => 'Total Marks',
            'mobtained' => 'Obtained Marks',
            'mpercent' => 'Percentage',
            'mgrade' => 'Grade/Division',
        ]);

        // Custom validation to ensure mobtained <= mtotal
        if ($request->mobtained > $request->mtotal) {
            return redirect()->back()->withErrors(['mobtained' => 'Obtained marks cannot be greater than Total marks.'])->withInput();
        }

        try {
            // Find or create the matric education record for the authenticated user
            $user = User::find(Auth::id());
            $matricEducation = Matriceducation::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'degree_id' => $validatedData['mdegree'],
                    'mboard' => $validatedData['mboard'],
                    'minstitute' => $validatedData['minstitute'],
                    'myear' => $validatedData['myear'],
                    'mexam' => $validatedData['mexam'],
                    'mroll' => $validatedData['mroll'],
                    'mtotal' => $validatedData['mtotal'],
                    'mobtained' => $validatedData['mobtained'],
                    'mpercent' => $validatedData['mpercent'],
                    'mgrade' => $validatedData['mgrade'],
                ]
            );

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'Matric education details updated successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Caught Error!',
                'alertMessage' => 'Unknown error occurred! Please try again later.',
            ]);
        }
    }

    public function updateInterEducation(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'idegree' => 'required|exists:degrees,id',
            'iboard' => 'required|string|max:100',
            'iinstitute' => 'required|string|max:255',
            'iyear' => 'required|integer|min:1900|max:2080',
            'iexam' => 'required|string|in:Annual,Supplementary',
            'iroll' => 'required|string|max:100',
            'itotal' => 'required|integer|min:1',
            'iobtained' => 'required|integer|min:0',
            'ipercent' => 'required|numeric|min:0|max:100',
            'igrade' => 'required|string|in:A,B,C,D,E,F',
        ], [], [
            'idegree' => 'Degree',
            'iboard' => 'Board',
            'iinstitute' => 'Name of Institution',
            'iyear' => 'Passing Year',
            'iexam' => 'Exam Type',
            'iroll' => 'Roll Number',
            'itotal' => 'Total Marks',
            'iobtained' => 'Obtained Marks',
            'ipercent' => 'Percentage',
            'igrade' => 'Grade/Division',
        ]);

        // Custom validation to ensure iobtained <= itotal
        if ($request->iobtained > $request->itotal) {
            return redirect()->back()->withErrors(['iobtained' => 'Obtained marks cannot be greater than total marks.'])->withInput();
        }

        try {
            $user = User::find(Auth::id());
            $interEducation = Intereducation::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'degree_id' => $validatedData['idegree'],
                    'iboard' => $validatedData['iboard'],
                    'iinstitute' => $validatedData['iinstitute'],
                    'iyear' => $validatedData['iyear'],
                    'iexam' => $validatedData['iexam'],
                    'iroll' => $validatedData['iroll'],
                    'itotal' => $validatedData['itotal'],
                    'iobtained' => $validatedData['iobtained'],
                    'ipercent' => $validatedData['ipercent'],
                    'igrade' => $validatedData['igrade'],
                ]
            );

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'Intermediate education details updated successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Caught Error!',
                'alertMessage' => 'Unknown error occurred! Please try again later.',
            ]);
        }
    }

    public function updateBaEducation(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'badegree' => 'required|exists:degrees,id',
            'baboard' => 'required|string|max:100',
            'bainstitute' => 'required|string|max:255',
            'bayear' => 'required|integer|min:1900|max:2080',
            'baexam' => 'required|string|in:Annual,Supplementary',
            'baroll' => 'required|string|max:100',
            'batotal' => 'required|integer|min:1',
            'baobtained' => 'required|integer|min:0',
            'bapercent' => 'required|numeric|min:0|max:100',
            'bagrade' => 'required|string|in:A,B,C,D,E,F',
        ], [], [
            'badegree' => 'Degree',
            'baboard' => 'Board',
            'bainstitute' => 'Name of Institution',
            'bayear' => 'Passing Year',
            'baexam' => 'Exam Type',
            'baroll' => 'Roll Number',
            'batotal' => 'Total Marks',
            'baobtained' => 'Obtained Marks',
            'bapercent' => 'Percentage',
            'bagrade' => 'Grade/Division',
        ]);

        // Custom validation to ensure baobtained <= batotal
        if ($request->baobtained > $request->batotal) {
            return redirect()->back()->withErrors(['baobtained' => 'Obtained marks cannot be greater than total marks.'])->withInput();
        }

        try {
            $user = User::find(Auth::id());
            $baEducation = Baeducation::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'degree_id' => $validatedData['badegree'],
                    'baboard' => $validatedData['baboard'],
                    'bainstitute' => $validatedData['bainstitute'],
                    'bayear' => $validatedData['bayear'],
                    'baexam' => $validatedData['baexam'],
                    'baroll' => $validatedData['baroll'],
                    'batotal' => $validatedData['batotal'],
                    'baobtained' => $validatedData['baobtained'],
                    'bapercent' => $validatedData['bapercent'],
                    'bagrade' => $validatedData['bagrade'],
                ]
            );

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'BA education details updated successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Caught Error!',
                'alertMessage' => 'Unknown error occurred! Please try again later.',
            ]);
        }
    }

    public function updateBsEducation(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'bsdegree' => 'required|exists:degrees,id',
            'bsboard' => 'required|string|max:100',
            'bsinstitute' => 'required|string|max:255',
            'bsyear' => 'required|integer|min:1900|max:2080',
            'bsexam' => 'required|string|in:Annual,Supplementary',
            'bsroll' => 'required|string|max:100',
            'bstotal' => 'required|integer|min:1',
            'bsobtained' => 'required|integer|min:0',
            'bspercent' => 'required|numeric|min:0|max:100',
            'bsgrade' => 'required|string|in:A,B,C,D,E,F',
        ], [], [
            'bsdegree' => 'Degree',
            'bsboard' => 'Board',
            'bsinstitute' => 'Name of Institution',
            'bsyear' => 'Passing Year',
            'bsexam' => 'Exam Type',
            'bsroll' => 'Roll Number',
            'bstotal' => 'Total Marks',
            'bsobtained' => 'Obtained Marks',
            'bspercent' => 'Percentage',
            'bsgrade' => 'Grade/Division',
        ]);

        // Custom validation to ensure bsobtained <= bstotal
        if ($request->bsobtained > $request->bstotal) {
            return redirect()->back()->withErrors(['bsobtained' => 'Obtained marks cannot be greater than total marks.'])->withInput();
        }

        try {
            $user = User::find(Auth::id());
            $bsEducation = Bseducation::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'degree_id' => $validatedData['bsdegree'],
                    'bsboard' => $validatedData['bsboard'],
                    'bsinstitute' => $validatedData['bsinstitute'],
                    'bsyear' => $validatedData['bsyear'],
                    'bsexam' => $validatedData['bsexam'],
                    'bsroll' => $validatedData['bsroll'],
                    'bstotal' => $validatedData['bstotal'],
                    'bsobtained' => $validatedData['bsobtained'],
                    'bspercent' => $validatedData['bspercent'],
                    'bsgrade' => $validatedData['bsgrade'],
                ]
            );

            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Action Successful!',
                'alertMessage' => 'BS education details updated successfully.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Caught Error!',
                'alertMessage' => 'Unknown error occurred! Please try again later.',
            ]);
        }
    }



}
