<?php

namespace App\Livewire\Plan;

use App\Livewire\Forms\PlanForm;
use App\Models\Plan;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class CreatePlan extends Component
{

    public PlanForm $form;

    public $title = 'Cadastrar Plano';

    #[On('create-plan')]
    public function create()
    {
        $this->form->populate(null);
        $this->resetValidation();
        $this->dispatch('show-modal', modal: 'modal-form-plan');
    }

    #[On('edit-plan')]
    public function edit($id)
    {
        $this->title = 'Editar Plano';
        $this->form->populate(Plan::find($id));
        $this->dispatch('show-modal', modal: 'modal-form-plan');
    }

    public function save()
    {
        $this->form->save();
        $this->dispatch('hide-modal', modal: 'modal-form-plan');
        $this->dispatch('refresh');
    }

    public function render(): View|Closure|string
    {
        return view('livewire.plan.create-plan');
    }
}
