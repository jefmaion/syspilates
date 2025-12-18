<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Livewire\Forms\RegistrationForm;
use App\Models\Registration;
use App\Traits\PaginationCollectionTrait;
use App\Traits\PaginationTrait;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class RegistrationShow extends Component
{
    use PaginationCollectionTrait;
    use PaginationTrait;

    public Registration $registration;

    public RegistrationForm $form;

    public $_classes = [];

    public $schedule = [];

    public $tab;

    public $cancel_comments;

    public function tabs(string $tab): void
    {
        $this->tab = $tab;
    }

    public function mount(Registration $registration)
    {
        $this->registration = $registration;
        $this->form->populate($this->registration);
    }

    public function changeClassDays()
    {
        $this->registration->schedule()->delete();
        $this->registration->schedule()->createMany($this->form->schedule);

        $this->dispatch('hide-modal', modal:'modal-classes');

        lw_alert($this, 'Salvo com sucesso!');

        return $this->dispatch('$refresh');
    }

    #[On('registration-updated')]
    public function refr() {
    }

    public function render(): View | Closure | string
    {
        // $this->pages = 5;

        return view('livewire.registration.registration-show', [
            'classes' => $this->paginate($this->registration->preClasses(), $this->pages),
        ]);
    }
}
