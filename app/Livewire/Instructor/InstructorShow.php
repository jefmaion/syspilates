<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Instructor;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class InstructorShow extends Component
{
    use WithPagination;

    public Instructor $instructor;

    public string $tab = 'tab-instructor-modality';

    public int $active;

    public function mount(Instructor $instructor): void
    {
        $this->instructor = $instructor->load('user');
        $this->active     = $this->instructor->user->active;
    }

    #[On('upload-avatar-finished')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function tabs(string $tab): void
    {
        $this->tab = $tab;
    }

    public function block()
    {
        $this->instructor->user()->update(['active' => $this->active]);
        $this->dispatch('show-alert', message:'Usuário ' . (($this->active) ? 'ativado' : 'bloqueado') . ' com sucesso!');
        $this->_refresh();
    }

    #[On('modality-attached')]
    #[On('modality-removed')]
    #[On('modality-updated')]
    #[On('instructor-updated')]
    public function _refresh(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.instructor.instructor-show', [
            'classes' => Classes::where('instructor_id', $this->instructor->id)->where('status', '<>', ClassStatusEnum::SCHEDULED)->paginate(10),
        ]);
    }
}
