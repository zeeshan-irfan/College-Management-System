<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $icon ='person-workspace',
        public string $icolor ='primary-emphasis',
        public int $count = 0,
        public string $sign = 'Total',
        public string $heading = 'Heading',
        public string $subheading = 'Subheading',

    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-card');
    }
}
