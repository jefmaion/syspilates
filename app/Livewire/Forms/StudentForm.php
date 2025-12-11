<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Models\User;
use Livewire\Form;

class StudentForm extends Form
{
    public ?string $profession = '';

    public ?string $objective = '';

    public ?Student $student;

    public function create(User $user): Student
    {
        return $user->student()->create($this->all());
    }

    public function update(): bool
    {
        return $this->student->update($this->all());
    }

    public function populate(?Student $student): void
    {
        $this->student = $student;

        $this->objective  = $student?->objective;
        $this->profession = $student?->profession;
    }
}
