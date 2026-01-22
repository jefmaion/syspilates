<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageClass extends Component
{
    public $status;

    public $evolution;

    public function mount()
    {
        $this->reset();
    }

    #[On('register-class')]
    public function show()
    {
        $this->dispatch('show-modal', modal:'show-register-class');
    }

    protected function rules()
    {
        return [
            'status'    => ['required'],
            'evolution' => ['required'],
        ];
    }

    public function submit()
    {
        $validated = $this->validate();

        $this->dispatch('send-class-data-form', ['status' => $this->status, 'evolution' => $this->evolution, ]);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.manage-class');
    }
}
