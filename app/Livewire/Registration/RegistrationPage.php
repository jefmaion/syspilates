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

    #[On('refresh-registrations')]
    public function _refresh()
    {
    }

    public function render(): View | Closure | string
    {
        return view('livewire.registration.registration-page', [
            'registrations' => Registration::with(['student.user', 'modality'])->whereHas('student.user', function ($query) {
                return $query->whereLike('name', '%' . $this->search . '%');
            })->orderBy('id', 'desc')->paginate($this->pages),
        ]);
    }
}
