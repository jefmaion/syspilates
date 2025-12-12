<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\GenderEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectGender extends Component
{
    public array $genders;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->genders = GenderEnum::cases();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-gender');
    }
}
