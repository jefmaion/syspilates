<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Features\SupportEvents\Event;

class DeletePlan extends Component
{
    public Plan $plan;

    #[On('delete-plan')]
    public function select(Plan $plan): Event
    {
        $this->plan = $plan;
        return $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function delete(): void
    {
        if ($this->plan->registrations()->count() > 0) {
            lw_alert($this, 'Não é possível excluir esse plano. Existem matrículas relacionadas à ele.', 'warning');
            return;
        }
        $this->plan->delete();
        session()->flash('info', 'Plano excluída com sucesso!');
        $this->redirect(route('plan'), navigate: true);
    }

    public function render(): View|Closure|string
    {
        return view('livewire.plan.delete-plan');
    }
}
