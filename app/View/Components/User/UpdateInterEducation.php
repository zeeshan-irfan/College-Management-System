<?php

namespace App\View\Components\User;

use App\Models\Degree;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class UpdateInterEducation extends Component
{
    public $degrees;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        try {
            // Fetch degrees with error handling for potential issues
            $this->degrees = Degree::where(['status' => true, 'type' => 'intermediate'])->get();
        } catch (\Exception $e) {
            // Log the exception and set $degrees to an empty collection
            Log::error('Error fetching degrees for UpdateMatricEducation: ' . $e->getMessage());
            $this->degrees = collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.update-inter-education');
    }
}
