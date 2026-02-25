<?php

declare(strict_types=1);

namespace App\Livewire\Registration;

use App\Enums\RegistrationStatusEnum;
use App\Livewire\Forms\RegistrationForm;
use App\Models\Plan;
use App\Models\Registration;
use App\Models\Student;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateRegistration extends Component
{
    public RegistrationForm $form;

    public Registration $registration;

    public ?Collection $students;

    #[On('create-registration')]
    public function create()
    {
        $this->resetValidation();
        $this->form->resetFields();

        $this->form->class_per_week = null;
        $this->form->start = date('Y-m-d');
        $this->form->deadline = date('d');

        $this->dispatch('show-modal', modal: 'modal-create-registration');
    }

    public function setPlan()
    {
        $plan = Plan::find($this->form->plan_id);

        $this->form->duration = $plan->duration;
        $this->form->class_per_week = (string) $plan->classes_per_week;
        $this->form->value = (string) $plan->value;
    }

    #[On('student-created')]
    public function setStudent(string $id)
    {
        $this->form->student_id =  $id;
    }

    #[On('renew-registration')]
    public function renew($id)
    {

        $this->registration = Registration::find($id);

        if ($this->registration->has_unpaid_transactions) {
            return lw_alert($this, 'Existem mensalidades pendentes! Finalize-as antes de renovar', 'danger');
        }

        $this->resetValidation();

        $this->form->renew = true;


        $start = $this->registration->lastClass->datetime->addDays(1);

        if ($start->isSunday()) {
            $start->addDay();
        }

        $this->registration->start = $start;

        $this->form->populate($this->registration);

        $this->dispatch('show-modal', modal: 'modal-create-registration');
    }

    #[On('store-registration')]
    public function save()
    {
        $registration = $this->form->create();

        if ($this->form->renew) {
            $this->registration->update(['status' => RegistrationStatusEnum::CLOSED]);
            $registration->update(['status' => RegistrationStatusEnum::SCHEDULED]);
        }

        $this->redirect(route('registration.show', $registration), navigate: true);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.create-registration');
    }
}
