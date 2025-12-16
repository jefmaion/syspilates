<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectTime extends Component
{
    public $times = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        for ($i = 7; $i <= 20; $i++) {
            $key               = $i . ':00';
            $this->times[$key] = $key;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-time');
    }
}
