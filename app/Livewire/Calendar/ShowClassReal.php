<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClassReal extends Component
{
    public Registration $registration;

    public Instructor $instructor;

    public $datetime;

    public $class;

    public $props;

    public $rules = [
        'status' => 'required',
    ];

    #[On('event-show')]
    public function show($id, $props)
    {
        $this->reset();

        $this->props = $props;

        $this->class = Classes::with(['registration', 'modality'])->find($id);

        $this->registration = $this->class->registration;
        $this->datetime     = Carbon::parse($this->props['datetime']);
        $this->instructor   = $this->class->instructor;

        $this->dispatch('show-modal', modal: 'modal-show-real');
    }

    public function editClass()
    {
        $data = [
            'status'    => $this->class->status->value,
            'evolution' => $this->class->evolution,
        ];

        $this->dispatch('show-form-register', rules: null, onSubmit: $this::class, data: $data);
    }

    #[On('save-class')]
    public function save($data)
    {
        $this->class->update($data);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class-real');
    }
}
