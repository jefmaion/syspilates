<?php

declare(strict_types = 1);

namespace App\Livewire\Registration;

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

    public $duration = null;

    #[On('refresh-registrations')]
    public function _refresh()
    {
    }

    public function render(): View | Closure | string
    {
        $registrations = Registration::with(['student.user', 'modality'])->whereHas('student.user', function ($query) {
            return $query->whereLike('name', '%' . $this->search . '%');
        });

        if (! empty($this->modality_id)) {
            $registrations->where('modality_id', $this->modality_id);
        }

        if (! empty($this->duration)) {
            $registrations->where('duration', $this->duration);
        }

        return view('livewire.registration.registration-page', [
            'registrations' => $registrations->orderBy('id', 'desc')->paginate($this->pages),
        ]);
    }
}
