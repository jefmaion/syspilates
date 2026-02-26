<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use App\Models\Student;
use App\Traits\PaginationTrait;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentPage extends Component
{
    use PaginationTrait;

    public ?Student $student;

    #[On('student-created')]
    #[On('student-updated')]
    public function refresh(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.student.student-page', [
            'students' => Student::with('user')->whereHas('user', function ($query) {
                return $query->whereLike('name', '%' . $this->search . '%')
                    ->orWhereLike('phone1', '%' . $this->search . '%')
                    ->orWhereLike('email', '%' . $this->search . '%');
            })->orderBy('id', 'desc')->paginate($this->pages),
        ]);
    }
}
