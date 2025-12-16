<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Models\Registration;
use App\Traits\PaginationTrait;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class RegistrationShow extends Component
{
    use PaginationTrait;

    protected $queryString = ['page'];

    public Registration $registration;

    public $page = 1;

    public $_classes = [];

    public function mount(Registration $registration)
    {
        $this->registration = $registration;

        $this->generateClasses();
    }

    public function generateClasses()
    {
        $this->registration->load('schedule.instructor.user');

        $plan      = $this->registration->plan;
        $schedules = $this->registration->schedule;

        $period = CarbonPeriod::create($plan->start, $plan->end);

        $this->_classes = [];

        foreach ($period as $date) {
            foreach ($schedules as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday) {
                    $this->_classes[] = [
                        'date'       => $date,
                        'time'       => $schedule->time,
                        'instructor' => $schedule->instructor,
                    ];
                }
            }
        }
    }

    public function render(): View | Closure | string
    {
        $perPage        = $this->pages;
        $currentPage    = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = Collection::make($this->_classes);

        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        $paginados = new LengthAwarePaginator(
            $currentPageItems,
            count($itemCollection),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.registration.registration-show', [
            'classes' => $paginados,
        ]);
    }
}
