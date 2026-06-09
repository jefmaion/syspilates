<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\Instructor;
use App\Models\User;
use App\Notifications\InstructorCreated;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class InstructorForm extends Form
{
    public ?string $profession = '';

    public ?string $comments = '';

    public ?string $document = '';

    public ?Instructor $instructor;

    public function create(User $user): Instructor
    {
        $user->instructor()->create($this->all());
        $user->update(['password' => Hash::make('password')]);
        $user->assignRole('Professor');




        return $user->instructor;
    }

    public function update(): bool
    {
        return $this->instructor->update($this->all());
    }

    public function populate(?Instructor $instructor): void
    {
        $this->instructor = $instructor;

        $this->comments   = $instructor?->comments;
        $this->document   = $instructor?->document;
        $this->profession = $instructor?->profession;
    }
}
