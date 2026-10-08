<?php

namespace App\Livewire\Fullcalendar;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

use Carbon\Carbon;
use App\Enums\ClassTypesEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Classes;
use App\Models\ExperimentalClass;
use App\Models\RegistrationSchedules;

use App\Livewire\Calendar\Events;

class Fullcalendar extends Component
{
    public $currentId;
    public $currentDate;
    public $currentView = 'week';
    public $events = [];
    public $isToday = false;

    public $startDate;
    public $endDate;

    public $dataclass;
    public $filters = [];


    // Propriedades do Menu
    public $showContextMenu = false;
    public $contextMenuX = 0;
    public $contextMenuY = 0;
    public $selectedContextMenuDate;


    public $holidays = [
        '2026-10-12' => 'Nossa Senhora Aparecida'
    ];
    
    public function mount($data=null)
    {
        $this->currentDate = Carbon::now()->startOfWeek(Carbon::MONDAY);

        $this->loadEvents();
        
        
    }

    public function next()
    {
        $date = Carbon::parse($this->currentDate);
        $this->currentDate = match($this->currentView) {
            'month' => $date->addMonth()->startOfMonth(),
            'week'  => $date->addWeek()->startOfWeek(Carbon::MONDAY),
            'day'   => $date->addDay(),
        };
        $this->loadEvents();
    }

    public function previous()
    {
        $date = Carbon::parse($this->currentDate);
        $this->currentDate = match($this->currentView) {
            'month' => $date->subMonth()->startOfMonth(),
            'week'  => $date->subWeek()->startOfWeek(Carbon::MONDAY),
            'day'   => $date->subDay(),
        };
        $this->loadEvents();
    }

      public function today()
    {
        $this->currentDate = Carbon::now();
        $this->changeView($this->currentView);
        $this->loadEvents();
    }


    #[On('open-context-menu')]
    public function openContextMenu($date, $x, $y)
    {
            // dd('opa');
        $this->selectedContextMenuDate = $date;
        $this->contextMenuX = $x;
        $this->contextMenuY = $y;
        $this->showContextMenu = true;
    }

    public function notifyChange() {


        // Dispara o evento para a página/pai escutar
        $this->dispatch('calendarPeriodChanged', start: $this->startDate, end: $this->endDate);
    }

    #[On('refresh-calendar')]
    public function loadEvents() {

        // $this->events = [];

        $datePointer = Carbon::parse($this->currentDate);

        // 1. Calcula dinamicamente o início e o fim baseado na View ativa
        switch ($this->currentView) {
            case 'month':
                // Pega desde a segunda-feira que inicia o grid do mês até o sábado que fecha
                $this->startDate = $datePointer->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY)->startOfDay();
                $this->endDate = $datePointer->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY)->endOfDay();
                break;

            case 'week':
                // Segunda a Sábado (respeitando o seu grid de 6 dias úteis)
                $this->startDate = $datePointer->copy()->startOfWeek(Carbon::MONDAY)->startOfDay();
                $this->endDate = $this->startDate->copy()->addDays(5)->endOfDay(); // Sábado
                break;

            case 'day':
                // O dia inteiro selecionado
                $this->startDate = $datePointer->copy()->startOfDay();
                $this->endDate = $datePointer->copy()->endOfDay();
                break;
        }

         $this->notifyChange();


     


     

    }

    #[On('calendar-filter')]
    public function filter($field, $value) {
        $this->filters[$field] = $value;
        $this->filters = array_filter($this->filters);
        $this->loadEvents();
    }

   
    #[On('updateCalendarEvents')]
    public function setData($data) {

        // $data =  (array) json_decode($data);

        $events = [];



        if($this->currentView == 'week' || $this->currentView == 'day') {
            foreach($data as $event) {
                $events[$event['start']][$event['type'].$event['id']] = $event;
            }
        }

        if($this->currentView == 'month') {
            foreach($data as $event) {
                $event['title'] = Carbon::parse($event['start'])->format('H\h') . ' '. $event['title'];
                $events[Carbon::parse($event['start'])->format('Y-m-d')][] = $event;
            }

            foreach ($events as $dateKey => &$dayEvents) {
                usort($dayEvents, function ($a, $b) {
                    return strtotime($a['start']) <=> strtotime($b['start']);
                });
            }
            unset($dayEvents);
        }

        $this->events = $events;
    }


    private function getData($startDate, $endDate) {

        $events = [];

        $classes = Classes::with(['student.user', 'registration.schedule'])->whereBetween('scheduled_datetime', [$startDate, $endDate])->whereHas('registration', function ($q) {
            return $q->justActives();
        })->whereNotIn('status', ['finish']);

        $classes       = $classes->get()->sortBy(function ($class) {
            return $class->student->user->nickname ?? $class->student->user->shortName;
        });

        $genClass = RegistrationSchedules::with(['registration.student.user', 'registration.classes'])->whereHas('registration', function ($q) {
            return $q->whereIn('status', ['active', 'scheduled']);
        });

        $experimentals = ExperimentalClass::with('modality')->whereBetween('datetime', [$startDate, $endDate])->get();


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



        $today = Carbon::today();
       $limit = $today->copy()->addDays(14);

       if(!$endDate->lt($today)) {


            if($startDate->lt($today)) {
                $startDate = $today->copy();
            }


            foreach($genClass  as $sched) {
                $current = $startDate->copy()->startOfDay();


                while($current->lte($endDate)) {

                    if($current->dayOfWeek != $sched->weekday->value) {
                        $current->addDay();
                        continue;
                    }

                    $dt = $current->format('Y-m-d');
                    $k = $sched->registration->id.'.'.Carbon::parse($dt.' '.$sched->time)->format('Y-m-d H:00');

                    // dd($exitsEvents, $k);

                    if(in_array($k, $exitsEvents)) {
                        $current->addDay();
                        continue;
                    }

                    $events[] = [
                        'id' => $sched->registration->id,
                        'title' => '<span class="status-dot status-indicator-animated icon-pulse"></span> ' . ($sched->registration->student->user->nickname ?? $sched->registration->student->user->shortName),
                        'start' => Carbon::parse($dt.' '.$sched->time)->format('Y-m-d H:00'),
                        'color' => 'secondary-lt',
                        'type' => 'sim',
                        'draggable' => 'false'
                    ];

   

                    $current->addDay();
                    
                }
                
            }
       }



       return $events;


       // dd($this->events);
    }

    #[On('move-event')]
    public function moveEvent($id, $datetime) {
        return Classes::find($id)->update(['datetime' => $datetime]);  
    }

    #[On('calendar-show-event')]
    public function open($id, $type, $start)
    {

        $this->currentId = $id;

        
        if($type == 'sim') {
            return $this->dispatch('show-sim-class', registration: $this->currentId, datetime:$start);
        }


        if ($type == ClassTypesEnum::EXPERIMENTAL->value) {
            return $this->dispatch('show-experimental-class', id: $this->currentId);
        }


        $class = Classes::find($this->currentId);


        return $this->dispatch('show-class-card', id: $class->id, type: $class->type->value, datetime: $class->datetime);
    }


    public function changeView($view)
    {
        $this->currentView = $view;
        
        // Ajusta o ponteiro da data para não quebrar a navegação ao alternar visões
        if ($view === 'month') {
            $this->currentDate = Carbon::parse($this->currentDate)->startOfMonth();
        } elseif ($view === 'week') {
            $this->currentDate = Carbon::parse($this->currentDate)->startOfWeek(Carbon::MONDAY);
        } else {
            $this->currentDate = Carbon::parse($this->currentDate);
        }

        $this->loadEvents();
    }

    public function render() : View|Closure|string
    {
        $hours = [];
        for ($h = 7; $h <= 21; $h++) {
            $hours[$h.'h'] = sprintf('%02d:00', $h);
        }

        // Geração da listagem de dias dinâmica com base na visão atual
        $days = [];
        $datePointer = Carbon::parse($this->currentDate);

        if ($this->currentView === 'week') {
            // Segunda a Sábado (ocultando Domingo conforme hiddenDays)
            $start = $datePointer->copy()->startOfWeek(Carbon::MONDAY);
            for ($i = 0; $i < 6; $i++) {
                $days[] = $start->copy()->addDays($i);
            }
        } elseif ($this->currentView === 'day') {
            $days[] = $datePointer;
        } elseif ($this->currentView === 'month') {
            // Mapeia todos os dias do mês atual
            $start = $datePointer->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
            $end = $datePointer->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
            
            while ($start->lte($end)) {
                if ($start->dayOfWeek !== Carbon::SUNDAY) { // Ignora domingos
                    $days[] = $start->copy();
                }
                $start->addDay();
            }
        }

        return view('livewire.fullcalendar.fullcalendar', [
            'days' => $days,
            'hours' => $hours
        ]);
    }
}
