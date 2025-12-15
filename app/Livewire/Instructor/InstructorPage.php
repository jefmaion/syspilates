<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use App\Traits\PaginationTrait;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorPage extends Component
{
    use PaginationTrait;

    public ?Instructor $instructor;

    #[On('delete-instructor')]
    public function select(Instructor $instructor): void
    {
        $this->instructor = $instructor;
        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    #[On('instructor-created')]
    #[On('instructor-updated')]
    public function refresh(): void
    {
        $this->dispatch('$refresh');
    }

    public function delete(): void
    {
        $this->instructor->user()->delete();
        $this->instructor->delete();
        $this->instructor = null;

        $this->dispatch('instructor-deleted');
        $this->dispatch('hide-modal', modal: 'modal-delete');
        $this->refresh();
    }

    public function render(): View
    {
        return view('livewire.instructor.instructor-page', [
            'instructors' => Instructor::with('user')->whereHas('user', function ($query) {
                return $query->whereLike('name', '%' . $this->search . '%');
            })->orderBy('id', 'desc')->paginate($this->pages),
        ]);
    }
}
