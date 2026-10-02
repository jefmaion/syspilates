<?php

namespace App\Livewire\Registration\Actions;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use App\Enums\RegistrationStatusEnum;
use App\Enums\ClassStatusEnum;
use App\Models\Registration;
use Livewire\Attributes\On;


class FinishRegistration extends Component
{
    public Registration $registration;

    public $cancel_comments;

    public function mount(Registration $registration)
    {
        $this->registration = $registration;
    }

    #[On('finish-registration')]
    public function show()
    {
        $this->dispatch('show-modal', modal:'modal-finish-registration');
    }

    public function finishRegistration() {

         $this->registration->update([
            'status'          => RegistrationStatusEnum::CLOSED,
            'cancel_date'     => now(),
        ]);

         $this->registration->classes()->where('status', ClassStatusEnum::SCHEDULED)->update(['status' => ClassStatusEnum::FINISH]);

        lw_alert($this, 'Matrícula finalizada com sucesso!');

        $this->dispatch('refresh-registration');
    }

    public function render() : View|Closure|string
    {
        return view('livewire.registration.actions.finish-registration');
    }
}
