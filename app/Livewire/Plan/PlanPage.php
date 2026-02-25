<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PlanPage extends Component
{

    use WithPagination;

    public $pages = 10;

    public $search = null;

    #[On('refresh')]
    public function _refresh() {}


    public function render(): View|Closure|string
    {
        return view('livewire.plan.plan-page', [
            'plans' => Plan::whereLike('name', '%' . $this->search . '%')->paginate($this->pages)
        ]);
    }
}
