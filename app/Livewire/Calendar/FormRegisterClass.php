<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormRegisterClass extends Component
{
    public $status;

    public $evolution;

    public $onSubmit;

    public $rules;

    public $type;

    public $fieldsExcept = [];

    #[On('show-form-register')]
    public function open($rules = [], $onSubmit = null, $data = null, $type = null)
    {
        $this->reset();
        $this->resetValidation();

        $this->onSubmit = $onSubmit;
        $this->rules    = $rules;
        $this->type     = $type;

        if (! empty($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        if ($this->type == 'absense') {
            $this->fieldsExcept = [ClassStatusEnum::SCHEDULED, ClassStatusEnum::PRESENCE];
        }

        if ($this->type == 'presence') {
            $this->status = ClassStatusEnum::PRESENCE;
            $this->rules  = [
                'evolution' => ['required'],
            ];
        }

        if ($this->type == 'absense') {
            $this->rules = [
                'evolution' => ['required'],
                'status'    => ['required'],
            ];
        }

        $this->dispatch('show-modal', modal:'modal-register-class');
    }

    public function submit()
    {
        $this->validate($this->rules);

        $this->dispatch('save-class', $this->only(['status', 'evolution']))->to($this->onSubmit);
        $this->dispatch('refresh-calendar');
        $this->dispatch('show-event-refresh');

        $this->dispatch('hide-modal', modal:'modal-register-class');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.form-register-class');
    }
}
