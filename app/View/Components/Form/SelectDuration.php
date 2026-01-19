<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\PlanEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectDuration extends Component
{
    public $durations;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->durations = PlanEnum::toSelectArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-duration');
    }
}
