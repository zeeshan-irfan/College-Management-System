<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTemplate extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id = "form",
        public string $routeid = "0",
        public string $method = "GET",
        public string $route = "",
        public string $heading = "Heading",
        public string $subheading = "Sub Heading",
        public string $button = "Save"
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-template');
    }
}
