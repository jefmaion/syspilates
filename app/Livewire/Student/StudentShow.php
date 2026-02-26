<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class StudentShow extends Component
{
    use WithPagination;

    public Student $student;

    public $tab = 'tabs-home-7';

    public $pages = 10;

    public function tabs(string $tab): void
    {
        $this->tab = $tab;
    }

    public function mount(Student $student): void
    {
        $this->student = $student->load('user');
    }

    #[On('upload-avatar-finished')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    public function deleteStudent(Student $student): void
    {
        $this->student = $student;
        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function delete(): void
    {

        if ($this->student->registrations->count()) {
            lw_alert($this, 'Não é possível excluir esse aluno. Existem matrículas relacionadas à ele');
            return;
        }

        $this->student->user()->delete();
        $this->student->delete();
        $this->student = null;

        $this->dispatch('student-deleted');
        $this->dispatch('hide-modal', modal: 'modal-delete');
        $this->refresh();
    }

    public function render(): View
    {
        return view('livewire.student.student-show', [
            'classes'      => Classes::with(['instructor.user', 'registration', 'modality'])->where('status', '<>', ClassStatusEnum::SCHEDULED)->where('student_id', $this->student->id)->paginate($this->pages, pageName: 'classes'),
            'transactions' => Transaction::with('category')->where('student_id', $this->student->id)->paginate($this->pages, pageName: 'transactions'),
        ]);
    }
}
