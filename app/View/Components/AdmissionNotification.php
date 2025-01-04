<?php

namespace App\View\Components;

use App\Models\Admission;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AdmissionNotification extends Component
{
    /**
     * Create a new component instance.
     */
    public string $message;
    public string $button;
    public string $route;

    public function __construct(
        string $button = 'Check Applied',
        string $route = 'user.applied',
    ) {
        // $this->message = 'Admissions are Closed!';
        $this->button = $button;
        $this->route = $route;
        $this->AdmissionMessage();
    }

    /**
     * Generate the admission message.
     */
    protected function AdmissionMessage(): void
    {
        $admissions = Admission::where('status', true)->get();

        if ($admissions->isEmpty()) {
            $this->message = 'No open admissions.';
        } else {
            $admissionCount = $admissions->count();
            $admissionDetails = $admissions->map(function ($admission, $index) use ($admissionCount) {
                $detail = "<i class='blink-text text-warning-emphasis bi bi-stars'></i> <span class='text-danger text-capitalize'>{$admission->semester} {$admission->batch}</span>";

                // Add a comma for all but the last two items
                if ($index < $admissionCount - 2) {
                    return $detail . ', <br>';
                }

                // Add an ampersand for the second-to-last item
                if ($index === $admissionCount - 2) {
                    return $detail . '<br> & <br>';
                }

                return $detail; // Last item, no extra character
            })->join(' ');

            $this->message = "Admissions are Open for <br> $admissionDetails";
            if(Auth::user()->roles->first()->name =='user')
            {
                $this->route = "admission.apply";
                $this->button = "Apply Now";
            }
        }
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admission-notification');
    }
}
