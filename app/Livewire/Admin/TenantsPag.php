<?php

namespace App\Livewire\Admin;

use Closure;
use Livewire\Component;
use Illuminate\View\View;

class TenantsPag extends Component
{
    public function render() : View|Closure|string
    {
        return view('livewire.admin.tenants-pag');
    }
}
