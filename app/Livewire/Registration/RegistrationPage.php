<?php

declare(strict_types=1);

namespace App\Livewire\Registration;

use App\Enums\RegistrationStatusEnum;
use App\Models\Registration;
use App\Traits\PaginationTrait;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class RegistrationPage extends Component
{
    use PaginationTrait;

    public $modality_id = null;

    public $plan_id = null;

    public $status;

    #[On('refresh-registrations')]
    public function _refresh() {}

    public function render(): View | Closure | string
    {
        $registrations = Registration::with(['student.user', 'modality', 'plan'])->whereHas('student.user', function ($query) {
            return $query->whereLike('name', '%' . $this->search . '%');
        });

        if (! empty($this->modality_id)) {
            $registrations->where('modality_id', $this->modality_id);
        }

        if (! empty($this->plan_id)) {
            $registrations->where('plan_id', $this->plan_id);
        }

        if (!empty($this->status)) {
            $registrations->current($this->status);
        }

        return view('livewire.registration.registration-page', [
            'registrations' => $registrations->orderBy('id', 'desc')->paginate($this->pages),

            'active' => Registration::actives()->count(),
            'today' => Registration::dueToday()->count(),
            'finished' => Registration::finisheds()->count(),
            'expired' => Registration::late()->count(),
            'canceled' => Registration::canceled()->count(),
        ]);
    }
}
