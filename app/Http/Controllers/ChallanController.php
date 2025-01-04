<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ChallanController extends Controller
{
    public function challanDownload($id)
    {
        // Find the record
        $record = Record::where('user_id', Auth::id())->where('id', $id)->first();

        // Check if record exists
        if (!$record) {
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'Not Found!',
                'alertMessage' => 'The requested record does not exist.',
            ]);
        }

        // Check if the challan exists
        if (!$record->challan) {
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'No Challan!',
                'alertMessage' => 'The challan associated with this record is missing.',
            ]);
        }

        try {
            // Set the PHP timeout to 30 seconds for PDF generation
            set_time_limit(30); // 30 seconds timeout

            // Render the HTML view into a string
            $view = view('user.challan', compact('record'))->render();

            // Generate the PDF from the HTML
            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isJavascriptEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'debug' => true
            ])
                ->setBasePath(public_path()) // Set base path
                ->loadHTML($view);

            // Output the generated PDF to the browser for inline viewing
            return $pdf->download('challan_' . $record->challan->challan_no . '.pdf');

        } catch (\Exception $e) {
            // Handle errors
            return back()->with([
                'alertType' => 'danger',
                'alertReason' => 'PDF Generation Failed!',
                'alertMessage' => 'Error generating PDF: ' . $e->getMessage(),
            ]);
        }
    }
}
