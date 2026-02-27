<?php

declare(strict_types=1);

namespace App\Livewire\Registration;

use App\Actions\GenerateRegistrationClasses;
use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Livewire\Forms\RegistrationForm;
use App\Models\Classes;
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


        $this->dispatch('hide-modal', modal: 'modal-classes');

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
        $this->dispatch('edit-class', id: $id)->to(UpdateClass::class);
    }

    public function render(): View | Closure | string
    {

        $this->authorize('view', $this->registration);

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

        // dd($this->registration->student->classes()->where('status', ClassStatusEnum::PRESENCE)->orderBy('datetime', 'desc')->get());

        $evolutions = Classes::with(['instructor.user'])->where('student_id', $this->registration->student_id)->where('modality_id',  $this->registration->modality_id)->where('status', ClassStatusEnum::PRESENCE)->orderBy('datetime', 'desc')->paginate(6, pageName: 'evolutions');

        return view('livewire.registration.registration-show', [
            'countClasses' => $this->registration->classes->count(),
            'classes'      => $classes->orderBy($this->_sortBy, $this->sortDirection)->paginate(8, pageName: 'classes'),
            'markups'      => $this->registration->makeups()->with('origin.instructor.user')->paginate(6, pageName: 'makeup'),
            'evolutions'   => $evolutions,
            'presences'    => $this->registration->classes()->where('status', ClassStatusEnum::PRESENCE)->count(),
            'scheduleds'   => $this->registration->classes()->where('status', ClassStatusEnum::SCHEDULED)->count(),
            'countMakeups' => $this->registration->classes()->where('type', ClassTypesEnum::MAKEUP)->count(),
            'total' => $this->registration->classes()->count(),
            'absenses'     => $this->registration->classes()->whereIn('status', [ClassStatusEnum::JUSTIFIED, ClassStatusEnum::ABSENSE, ClassStatusEnum::CANCELED])->count(),
            'transactions' => $this->registration->transactions,
        ]);
    }
}
