<?php

declare(strict_types = 1);

namespace App\Livewire\Admin;

use Closure;
use Illuminate\View\View;
use Livewire\Component;

class Tenants extends Component
{
    public function render(): View | Closure | string
    {
        return view('livewire.admin.tenants');
    }
}
