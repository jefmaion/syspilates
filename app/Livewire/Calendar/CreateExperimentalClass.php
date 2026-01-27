<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\ExperimentalClass;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateExperimentalClass extends Component
{
    public $datetime;

    public $name;

    public $phone;

    public $modality_id;

    public $instructor_id;

    public $value;

    public $comments;

    public $class;

    public $date;

    public $time;

    public $update = false;

    #[On('create-experimental-class')]
    public function show($datetime)
    {
        $this->datetime = Carbon::parse($datetime);
        $this->date     = $this->datetime->format('Y-m-d');
        $this->time     = $this->datetime->format('H:i:s');

        $this->dispatch('show-modal', modal:'modal-experimental');
    }

    #[On('edit-experimental-class')]
    public function edit($id)
    {
        $this->class = ExperimentalClass::find($id);

        $this->datetime = Carbon::parse($this->class->datetime);

        $this->date = $this->datetime->format('Y-m-d');
        $this->time = $this->datetime->format('H:i:s');

        $this->name          = $this->class->name;
        $this->phone         = $this->class->phone;
        $this->modality_id   = $this->class->modality_id;
        $this->instructor_id = $this->class->instructor_id;
        $this->value         = $this->class->value;
        $this->comments      = $this->class->comments;

        $this->update = true;

        $this->dispatch('show-modal', modal:'modal-experimental');
    }

    public function update()
    {
        $this->class->update([
            'datetime'      => Carbon::parse($this->date . ' ' . $this->time),
            'name'          => $this->name,
            'phone'         => $this->phone,
            'modality_id'   => $this->modality_id,
            'instructor_id' => $this->instructor_id,
            'value'         => $this->value,
            'comments'      => $this->comments,
        ]);
        $this->update = false;
    }

    public function save()
    {
        $this->validate([
            'name'          => ['required'],
            'phone'         => ['required'],
            'modality_id'   => ['required'],
            'instructor_id' => ['required'],
            'date'          => ['required'],
            'time'          => ['required'],

        ]);

        if (! $this->update) {
            $this->class = ExperimentalClass::create([
                'datetime'      => $this->datetime,
                'name'          => $this->name,
                'phone'         => $this->phone,
                'modality_id'   => $this->modality_id,
                'instructor_id' => $this->instructor_id,
                'value'         => $this->value,
                'comments'      => $this->comments,
            ]);
        } else {
            $this->update();
        }

        $this->dispatch('hide-modal', modal:'modal-experimental');
        $this->dispatch('refresh-experimental-class', id:$this->class->id);
        $this->dispatch('refresh-calendar');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.create-experimental-class');
    }
}
