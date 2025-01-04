<?php

namespace App\View\Components\Admin;

use App\Models\Admission;
use App\Models\Program;
use App\Models\Record;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllApplications extends Component
{
    public $records;

    /**
     * Create a new component instance.
     */
    public function __construct($records)
    {
        // Fetch all records from the Record model
        $this->records = $records;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.all-applications', [
            'records' => $this->records, // Pass the records to the view
        ]);
    }
}
