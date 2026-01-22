<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\ClassStatusEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectClassStatus extends Component
{
    public $status;

    /**
     * Create a new component instance.
     */
    public function __construct($except = [])
    {
        $this->status = ClassStatusEnum::toSelectArray($except);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-class-status');
    }
}
