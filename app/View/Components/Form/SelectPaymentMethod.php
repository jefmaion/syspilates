<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Enums\PaymentMethodEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectPaymentMethod extends Component
{
    public $payments = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->payments = PaymentMethodEnum::toSelectArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-payment-method');
    }
}
