<?php

declare(strict_types = 1);

namespace App\Livewire\Student;

use App\Models\Student;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteStudent extends Component
{
    public Student $student;

    #[On('delete-student')]
    public function select(Student $student): void
    {
        $this->student = $student;

        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function delete(): void
    {
        $this->student->user()->delete();
        $this->student->delete();
        $this->dispatch('student-deleted');

        session()->flash('info', 'Aluno excluído com sucesso!');
        $this->redirect(route('student'), navigate:true);
    }

    public function render(): View
    {
        return view('livewire.student.delete-student');
    }
}
