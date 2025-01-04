<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertBox extends Component
{
    public string $alertIcon = "";
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $alertType="success",
        public string $alertReason='',
        public string $alertMessage = ''
    )
    {
       // Set the alert icon based on the alert type
       $this->alertIcon = match ($alertType) {
        'success' => '<i class="bi bi-check-circle"></i>',
        'danger' => '<i class="bi bi-x-circle"></i>',
        'warning' => '<i class="bi bi-exclamation-triangle"></i>',
        'info' => '<i class="bi bi-info-circle"></i>',
        default => '', // Fallback if no type matches
    };
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-box');
    }
}
