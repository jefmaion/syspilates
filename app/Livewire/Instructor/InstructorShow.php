<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorShow extends Component
{
    public Instructor $instructor;

    public string $tab = 'tabs-home-7';

    public function mount(Instructor $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function tabs(string $tab): void
    {
        $this->tab = $tab;
    }

    #[On('modality-attached')]
    #[On('modality-removed')]
    #[On('modality-updated')]
    public function _refresh(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.instructor.instructor-show');
    }
}
