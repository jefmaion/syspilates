<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Livewire\Forms\RegistrationForm;
use App\Models\ClassMakeup;
use App\Models\Registration;
use App\Traits\PaginationCollectionTrait;
use App\Traits\PaginationTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

    public $search_scheduled;

    public $cancel_comments;

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
        $this->registration->schedule()->delete();
        $this->registration->schedule()->createMany($this->form->schedule);
        $this->registration->classes()->where('status', ClassStatusEnum::SCHEDULED)->where('type', ClassTypesEnum::REGULAR)->delete();

        $period = CarbonPeriod::create(now()->addDay(1), $this->registration->end);

        foreach ($period as $date) {
            foreach ($this->registration->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {
                    $this->registration->classes()->create([
                        'student_id'               => $this->registration->student_id,
                        'modality_id'              => $this->registration->modality_id,
                        'datetime'                 => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                        'instructor_id'            => $schedule->instructor_id,
                        'scheduled_datetime'       => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                        'type'                     => ClassTypesEnum::REGULAR,
                        'registration_schedule_id' => $schedule->id,
                        'status'                   => ClassStatusEnum::SCHEDULED,
                    ]);
                }
            }
        }

        $this->dispatch('hide-modal', modal:'modal-classes');

        lw_alert($this, 'Dias de aulas alteradas com sucesso');

        return $this->dispatch('$refresh');
    }

    // public function generateClasses()
    // {
    //     $this->registration->load('schedule.instructor.user');
    //     $period = CarbonPeriod::create($this->registration->start, $this->registration->end);

    //     $classes = [];

    //     foreach ($period as $date) {
    //         foreach ($this->registration->schedule as $schedule) {
    //             if ($date->dayOfWeek === $schedule->weekday->value) {
    //                 $classes[$date->format('Y-m-d')] = [
    //                     'date'       => $date,
    //                     'time'       => $schedule->time,
    //                     'datetime'   => $date . 'T' . $schedule->time,
    //                     'instructor' => $schedule->instructor,
    //                     'status'     => ClassStatusEnum::SCHEDULED,
    //                 ];
    //             }
    //         }
    //     }

    //     return $classes;
    // }

    #[On('refresh-registration')]
    #[On('class-saved')]
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
        return view('livewire.registration.registration-show', [
            'scheduled' => $this->registration->classes()->whereLike('datetime', '%' . $this->search_scheduled . '%')->where('status', ClassStatusEnum::SCHEDULED)->paginate(8, pageName: 'scheduled'),
            'classes'   => $this->registration->classes()->where('status', ClassStatusEnum::PRESENCE)->orderBy('datetime', 'desc')->paginate(pageName: 'executed'),
            'absenses'  => $this->registration->classes()->whereNotIn('status', [ClassStatusEnum::PRESENCE, ClassStatusEnum::SCHEDULED])->paginate(pageName: 'absensed'),
            'markups'   => ClassMakeup::with(['origin'])->where('status', 'active')->where('student_id', $this->registration->student_id)->get(),
        ]);
    }
}
