<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ProfilePercentage extends Component
{
    /**
     * The calculated profile completion percentage.
     */
    public int $count;

    /**
     * Whether to display only the number.
     */
    public bool $number;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $number = false)
    {
        $this->number = $number;

        // Initialize count to the base value
        $this->count = 10;

        $this->count += optional(Auth::user()->personalinfo)->exists() ? 10 : 0;
        $this->count += optional(Auth::user()->image)->exists() ? 10 : 0;
        $this->count += optional(Auth::user()->fatherinfo)->exists() ? 10 : 0;
        $this->count += optional(Auth::user()->address)->exists() ? 10 : 0;
        $this->count += optional(Auth::user()->matriceducation)->exists() ? 15 : 0;
        $this->count += optional(Auth::user()->intereducation)->exists() ? 15 : 0;
        $this->count += optional(Auth::user()->baeducation)->exists() ? 10 : 0;
        $this->count += optional(Auth::user()->bseducation)->exists() ? 10 : 0;

        // Ensure count does not exceed 100%
        $this->count = min($this->count, 100);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.profile-percentage');
    }
}
