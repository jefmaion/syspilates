<?php

namespace App\Livewire\Plan;

use Closure;
use Livewire\Component;
use Illuminate\View\View;

class UpdatePlan extends Component
{

    public $title = 'Cadastrar Plano';

    public function render(): View|Closure|string
    {
        return view('livewire.plan.update-plan');
    }
}
