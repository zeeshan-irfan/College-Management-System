<?php

namespace App\View\Components\Admin;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllDepartments extends Component
{
    /**
     * The paginated departments.
     */
    public $departments;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch departments ordered by name in ascending order with pagination
        $this->departments = Department::orderBy('name', 'asc')->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.admin.all-departments', ['departments' => $this->departments]);
    }
}
