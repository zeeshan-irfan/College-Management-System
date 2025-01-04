<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AdmissionForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $admissions = null,
        public $programs = null,
    ) {
        $this->admissions = collect($this->admissions ?: []);
        $this->programs = collect($this->programs ?: []);
    }


    private function calculateProfileCompletion(): int
    {
        $count = 10; // Starting percentage
        $user = Auth::user();

        $count += optional($user->personalinfo)->exists() ? 10 : 0;
        $count += optional($user->image)->exists() ? 10 : 0;
        $count += optional($user->fatherinfo)->exists() ? 10 : 0;
        $count += optional($user->address)->exists() ? 10 : 0;
        $count += optional($user->matriceducation)->exists() ? 15 : 0;
        $count += optional($user->intereducation)->exists() ? 15 : 0;
        $count += optional($user->baeducation)->exists() ? 10 : 0;
        $count += optional($user->bseducation)->exists() ? 10 : 0;

        return min($count, 100);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.admission-form', [
            'percentage' => $this->calculateProfileCompletion()
        ]);
    }
}
