<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\TransactionTypeEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectTransactionType extends Component
{
    public $types = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->types = TransactionTypeEnum::toSelectArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-transaction-type');
    }
}
