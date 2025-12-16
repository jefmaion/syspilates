<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectDuration extends Component
{
    public $durations = [
        30  => 'Mensal',
        60  => 'Bimestral',
        90  => 'Trimestral',
        120 => 'Quadrimestral',
        160 => 'Semestral',
        365 => 'Anual',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-duration');
    }
}
