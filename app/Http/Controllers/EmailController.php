<?php

namespace App\Http\Controllers;

use App\Mail\email\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $details = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        try {
            // Attempt to send the email
            Mail::to('laraveltestingprofile@gmail.com')->send(new ContactMail($details));

            // Return a success message if the email is sent successfully
            return redirect()->back()->with([
                'alertType' => 'success',
                'alertReason' => 'Email Sent!',
                'alertMessage' => 'Your message has been sent successfully.',
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Email sending failed:', [
                'error_message' => $e->getMessage(),
                'email' => $request->input('email'),
                'time' => now()->toDateTimeString(),
            ]);

            // Return an error message to the user
            return redirect()->back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Email Failed!',
                'alertMessage' => 'There was an issue sending your message. Please try again later.',
            ]);
        }
    }
}