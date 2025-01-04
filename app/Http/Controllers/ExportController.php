<?php

namespace App\Http\Controllers;

use App\Exports\RecordExport;
use App\Models\Admission;
use App\Models\Program;
use App\Models\Record;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        $admissions = Admission::all();
        $programs=Program::all();

        return view('admin.download',compact('admissions','programs'));
    }

    public function export(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'admission' => 'required|exists:admissions,id', // Admission is required
            'program' => 'nullable|exists:programs,id',     // Program is optional
        ]);

        // Fetch records based on the validated input
        $query = Record::with('user.personalinfo', 'user.fatherinfo', 'user.address', 'challan', 'admission', 'program')
            ->where('admission_id', $validated['admission']); // Filter by admission

        // If 'program' is provided, filter by it
        if (!empty($validated['program'])) {
            $query->where('program_id', $validated['program']);
        }

        // Order by program name
        $query->join('programs', 'records.program_id', '=', 'programs.id')
              ->orderBy('programs.name', 'asc');

        $records = $query->get(); // Execute the query

        // Return the Excel download response
        $fileName = 'records_' . $validated['admission'] . ($validated['program'] ? '_' . $validated['program'] : '') . '.xlsx';

        return Excel::download(
            new RecordExport($records), $fileName
        );
    }
}
