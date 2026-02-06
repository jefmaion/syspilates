<?php

namespace App\Livewire\Calendar;

use App\Models\Classes;
use App\Models\ExperimentalClass;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class TodayClass extends Component
{

    public $date;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    #[On('class-saved')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function render(): View|Closure|string
    {

        $classes = Classes::with(['student.user', 'instructor.user', 'registration', 'modality'])->whereDate('datetime', $this->date)->orderBy('datetime')->get();
        $experimentals = ExperimentalClass::with('modality')->whereDate('datetime', $this->date)->orderBy('datetime')->get();



        $data = [];
        $rs = [];
        foreach ($classes as $class) {
            $data[$class->datetime->format('H')][] = $class;
            $rs[$class->datetime->format('H')][] = [
                'isClass' => true,
                'isReposition' => $class->is_makeup,
                'id' => $class->id,
                'type' => $class->type,
                'student' => $class->student->user,
                'initials' => $class->student->user->initials,
                'avatar' => $class->student->user->avatar,
                'status' => $class->status,
                'modality' => $class->modality->name,
                'phone' => $class->student->user->phone1,
                'instructor' => $class->instructor->user,
                'instructor_name' => $class->instructor->user->shortName,
                'objective' => $class->student->objective,
                'evolutions' => $class->student->getLastEvolutions($class->registration_id)
            ];
        }


        $exps = [];
        foreach ($experimentals as $exp) {

            $rs[$exp->datetime->format('H')][] = [
                'isClass' => false,
                'isReposition' => false,
                'id' => $exp->id,
                'type' => 'exp',
                'student' => $exp->name,
                'initials' => initials($exp->name),
                'avatar' => null,
                'phone' => $exp->phone,
                'status' => $exp->status,
                'modality' => $exp->modality->name,
                'instructor' => $exp->instructor->user,
                'instructor_name' => $exp->instructor->user->shortName,
                'objective' => $exp->comments,
            ];
        }

        return view('livewire.calendar.today-class', [
            'classes' => $data,
            'rs' => $rs
        ]);
    }
}
