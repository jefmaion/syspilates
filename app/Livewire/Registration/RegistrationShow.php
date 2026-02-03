<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Actions\GenerateRegistrationClasses;
use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Livewire\Forms\RegistrationForm;
use App\Models\Registration;
use App\Traits\PaginationCollectionTrait;
use App\Traits\PaginationTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class RegistrationShow extends Component
{
    use PaginationCollectionTrait;
    // use PaginationTrait;

    use WithPagination;

    public Registration $registration;

    public RegistrationForm $form;

    public $_classes = [];

    public $schedule = [];

    public $tab = 'tab-scheduled';

    public $search_scheduled;

    public $cancel_comments;

    public $searchClass = null;

    public array $filter = [];

    public $_sortBy = 'id';

    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->_sortBy === $field) {
            // alterna asc/desc
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // muda a coluna e volta para asc
            $this->_sortBy       = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function tabs(string $tab): void
    {
        $this->tab = $tab;
    }

    public function mount(Registration $registration)
    {
        $this->pages        = 5;
        $this->registration = $registration;
        $this->form->populate($this->registration);
    }

    public function changeClassDays()
    {
        $nextClass = $this->registration->nextClass;

        $this->registration->schedule()->delete();
        $this->registration->schedule()->createMany($this->form->schedule);
        $this->registration->classes()->whereDate('datetime', '>=', $nextClass->datetime)->where('status', ClassStatusEnum::SCHEDULED)->where('type', ClassTypesEnum::REGULAR)->delete();

        GenerateRegistrationClasses::run($this->registration, $nextClass->datetime, $this->registration->end);

        // $period = CarbonPeriod::create($nextClass->datetime, $this->registration->end);

        // $countClasses = 0;

        // foreach ($period as $date) {
        //     foreach ($this->registration->schedule as $schedule) {
        //         if ($date->dayOfWeek === $schedule->weekday->value) {
        //             $this->registration->classes()->create([
        //                 'student_id'               => $this->registration->student_id,
        //                 'modality_id'              => $this->registration->modality_id,
        //                 'datetime'                 => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
        //                 'instructor_id'            => $schedule->instructor_id,
        //                 'scheduled_datetime'       => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
        //                 'type'                     => ClassTypesEnum::REGULAR,
        //                 'registration_schedule_id' => $schedule->id,
        //                 'status'                   => ClassStatusEnum::SCHEDULED,
        //             ]);
        //             $countClasses++;
        //         }
        //     }
        // }

        // $this->registration->update(['class_value' => $this->registration->value / $countClasses]);

        $this->dispatch('hide-modal', modal:'modal-classes');

        lw_alert($this, 'Dias de aulas alteradas com sucesso');

        return $this->dispatch('$refresh');
    }

    #[On('refresh-registration')]
    #[On('class-saved')]
    #[On('transaction-registered')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function editClass($id)
    {
        $this->dispatch('edit-class', id:$id)->to(UpdateClass::class);
    }

    public function render(): View | Closure | string
    {
        $classes = $this->registration->classes();

        foreach ($this->filter as $field => $value) {
            if (empty($value)) {
                continue;
            }

            if ($field == 'weekday') {
                $classes->whereRaw('DAYOFWEEK(datetime) = ?', [$value]);

                continue;
            }

            if ($field == 'time') {
                $classes->whereRaw('DAYOFWEEK(datetime) = ?', [$value]);

                continue;
            }

            $classes->where($field, $value);
        }

        return view('livewire.registration.registration-show', [
            'countClasses' => $this->registration->classes->count(),
            'classes'      => $classes->orderBy($this->_sortBy, $this->sortDirection)->paginate(8, pageName:'classes'),
            'markups'      => $this->registration->makeups()->with('origin.instructor.user')->paginate(6, pageName:'makeup'),
            'evolutions'   => $this->registration->classes()->where('status', ClassStatusEnum::PRESENCE)->orderBy('datetime', 'desc')->paginate(6, pageName:'evolutions'),
            'presences'    => $this->registration->classes()->where('status', ClassStatusEnum::PRESENCE)->count(),
            'scheduleds'   => $this->registration->classes()->where('status', ClassStatusEnum::SCHEDULED)->count(),
            'countMakeups' => $this->registration->classes()->where('type', ClassTypesEnum::MAKEUP)->count(),
            'absenses'     => $this->registration->classes()->whereIn('status', [ClassStatusEnum::JUSTIFIED, ClassStatusEnum::ABSENSE, ClassStatusEnum::CANCELED])->count(),
            'transactions' => $this->registration->transactions,
        ]);
    }
}
