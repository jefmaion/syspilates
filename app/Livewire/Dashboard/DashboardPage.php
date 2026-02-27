<?php

namespace App\Livewire\Dashboard;

use Closure;
use Livewire\Component;
use Illuminate\View\View;

class DashboardPage extends Component
{
    public function render() : View|Closure|string
    {
        return view('livewire.dashboard.dashboard-page');
    }
}
