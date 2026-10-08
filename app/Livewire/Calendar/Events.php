<?php

namespace App\Livewire\Calendar;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

use App\Models\Student;


use Carbon\Carbon;
use App\Enums\ClassTypesEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Classes;
use App\Models\ExperimentalClass;
use App\Models\RegistrationSchedules;

class Events extends Component
{

    public $start;
    public $end;


    public $filter = [];

    


    #[On('calendarPeriodChanged')]
    public function getData($start, $end, $filters=[]) {

        $this->start = Carbon::parse($start);
        $this->end = Carbon::parse($end);


        $start = $this->start;
        $end = $this->end;

  



        $events = [];

        $classes = Classes::with(['student.user', 'registration.schedule'])->whereBetween('scheduled_datetime', [$this->start, $this->end])->whereHas('registration', function ($q) {
            return $q->justActives();
        })->whereNotIn('status', ['finish']);

        $genClass = RegistrationSchedules::with(['registration.student.user', 'registration.classes'])->whereHas('registration', function ($q) {
            return $q->whereIn('status', ['active', 'scheduled']);
        });

        $experimentals = ExperimentalClass::with('modality')->whereBetween('datetime', [$this->start, $this->end]);


 
        foreach($filters as $key => $value) {
            $classes->where($key, $value);
        }

        if(isset($filters['status'])) {
            $experimentals->where('status',$this->filter['status']);
        }


      
        $classes       = $classes->get()->sortBy(function ($class) {
            return $class->student->user->nickname ?? $class->student->user->shortName;
        });

        $experimentals = $experimentals->get();


        


        $genClass = $genClass->get();


        $exitsEvents = [];
        

        foreach ($classes as $class) {

            $exitsEvents[] = $class->registration->id.'.'.$class->datetime->format('Y-m-d H:00');
            $badge = '';
            if ($class->type !== ClassTypesEnum::REGULAR) {
              $badge = '<span class="badge bg-dark text-dark-fg  px-1 py-1">' . $class->type->nick() . '</span> ';
            }


            $events[] = [
                'id' => $class->id,
                'start' => $class->datetime->format('Y-m-d H:00'),
                'title' => $badge .$class->student->user->nickname ?? $class->student->user->shortName,
                'color' => $class->status->color(),
                'type' => 'sch',
                'draggable' => 'true'
            ];
        }




        foreach ($experimentals as $exp) {

             $events[] = [
                'id' => $exp->id,
                'start' => $exp->datetime->format('Y-m-d H:00'),
                'title' => $exp->name . ' (' . $exp->modality->acronym . ')',
                'color' => ClassTypesEnum::EXPERIMENTAL->color(),
                'type'  => ClassTypesEnum::EXPERIMENTAL->value,
                'draggable' => 'true'
            ];

        }



       //  $today = Carbon::today();
       // $limit = $today->copy()->addDays(14);

       // if(!$end->lt($today)) {


       //      if($start->lt($today)) {
       //          $start = $today->copy();
       //      }


       //      foreach($genClass  as $sched) {
       //          $current = $start->copy()->startOfDay();


       //          while($current->lte($end)) {

       //              if($current->dayOfWeek != $sched->weekday->value) {
       //                  $current->addDay();
       //                  continue;
       //              }

       //              $dt = $current->format('Y-m-d');
       //              $k = $sched->registration->id.'.'.Carbon::parse($dt.' '.$sched->time)->format('Y-m-d H:00');

       //              // dd($exitsEvents, $k);

       //              if(in_array($k, $exitsEvents)) {
       //                  $current->addDay();
       //                  continue;
       //              }

       //              $events[] = [
       //                  'id' => $sched->registration->id,
       //                  'title' => '<span class="status-dot status-indicator-animated icon-pulse"></span> ' . ($sched->registration->student->user->nickname ?? $sched->registration->student->user->shortName),
       //                  'start' => Carbon::parse($dt.' '.$sched->time)->format('Y-m-d H:00'),
       //                  'color' => 'secondary-lt',
       //                  'type' => 'sim',
       //                  'draggable' => 'false'
       //              ];

   

       //              $current->addDay();
                    
       //          }
                
       //      }
       // }

       // $this->data = $events;

       
       // dd($events);

       


       $this->dispatch('updateCalendarEvents', data:($events));
    }

    public function filters($field, $value) {


        $this->filter[$field] = $value;

        $this->filter = array_filter($this->filter);

        $this->getData($this->start, $this->end);
    }

    public function render() : View|Closure|string
    {

        // $this->getData();

        $students = Student::whereHas('registrations', function ($q) {
            return $q->justActives();
        })->with('user')->get()->sortBy('user.name')->pluck('user.name', 'id');


        return view('livewire.calendar.events', [
            'students' => $students,
            'dataclass' => $this::class
        ]);
    }
}
