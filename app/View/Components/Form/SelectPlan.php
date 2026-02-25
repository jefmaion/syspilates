<?php

namespace App\View\Components\Form;

use App\Models\Plan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectPlan extends Component
{

    public $plans;
    public $show_value = false;

    /**
     * Create a new component instance.
     */
    public function __construct($showValue = false)
    {
        $this->plans = Plan::get();
        $this->show_value = $showValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-plan');
    }
}
