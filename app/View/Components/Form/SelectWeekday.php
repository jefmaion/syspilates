<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\WeekdaysEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectWeekday extends Component
{
    public $weekdays = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->weekdays = WeekdaysEnum::cases();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-weekday');
    }
}
