<?php

declare(strict_types = 1);

namespace App\Livewire\Registration\Actions;

use App\Enums\RegistrationStatusEnum;
use App\Models\Registration;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CancelRegistration extends Component
{
    public Registration $registration;

    public $cancel_comments;

    public function mount(Registration $registration)
    {
        $this->registration = $registration;
    }

    #[On('cancel-registration')]
    public function show()
    {
        $this->dispatch('show-modal', modal:'modal-cancel-registration');
    }

    public function cancel()
    {
        $this->registration->update([
            'status'          => RegistrationStatusEnum::CANCELED,
            'cancel_date'     => now(),
            'cancel_comments' => $this->cancel_comments,
        ]);

        lw_alert($this, 'Salvo com sucesso!');

        $this->dispatch('hide-modal', modal:'modal-cancel-registration');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.actions.cancel-registration');
    }
}
