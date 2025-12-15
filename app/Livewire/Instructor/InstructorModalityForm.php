<?php

declare(strict_types = 1);

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Closure;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorModalityForm extends Component
{
    public Instructor $instructor;

    public int $modality_id;

    public string $commission_type = 'percent';

    public ?float  $commission_value = null;

    public bool $calculate_on_justified_absence = true;

    public bool $edit = false;

    public string $label = 'Valor da comissão';

    public function mount(Instructor $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function setComissionLabel(): void
    {
        $this->label = ($this->commission_type == 'percent') ? '% da comissão' : 'Valor da comissão';
    }

    #[On('edit-modality')]
    public function editModality(int $modalityId): void
    {
        $pivot = $this->instructor
            ->modalities()
            ->where('modality_id', $modalityId)
            ->first()
            ->pivot;

        $this->modality_id                    = $modalityId;
        $this->commission_type                = $pivot->commission_type;
        $this->commission_value               = (float) $pivot->commission_value;
        $this->calculate_on_justified_absence = (bool) $pivot->calculate_on_justified_absence;

        $this->edit = true;

        $this->resetValidation();
        $this->dispatch('show-modal', modal: 'modal-form-instructor-modality');
    }

    public function update(): void
    {
        $this->validate([
            'commission_type'                => 'required|in:percent,fixed',
            'commission_value'               => 'required|numeric|min:0',
            'calculate_on_justified_absence' => 'boolean',
        ]);

        $this->instructor->modalities()->updateExistingPivot($this->modality_id, [
            'commission_type'                => $this->commission_type,
            'commission_value'               => $this->commission_value,
            'calculate_on_justified_absence' => $this->calculate_on_justified_absence,
        ]);

        $this->edit = false;

        $this->dispatch('hide-modal', modal: 'modal-form-instructor-modality');
        $this->dispatch('modality-updated');
    }

    #[On('attach-modality')]
    public function addModality(): void
    {
        $this->edit = false;
        $this->resetValidation();
        $this->reset('modality_id', 'commission_type', 'commission_value', 'calculate_on_justified_absence');
        $this->dispatch('show-modal', modal: 'modal-form-instructor-modality');
    }

    public function add(): void
    {
        $this->validate([
            'modality_id'                    => ['required', 'exists:modalities,id', Rule::unique('instructor_modality', 'modality_id')->where('instructor_id', $this->instructor->id), ],
            'commission_type'                => 'required|in:percent,fixed',
            'commission_value'               => 'required|numeric|min:0',
            'calculate_on_justified_absence' => 'boolean',
        ]);

        $this->instructor->modalities()->attach($this->modality_id, [
            'commission_type'                => $this->commission_type,
            'commission_value'               => $this->commission_value,
            'calculate_on_justified_absence' => $this->calculate_on_justified_absence,
        ]);

        $this->dispatch('hide-modal', modal: 'modal-form-instructor-modality');
        $this->dispatch('modality-attached');
    }

    #[On('remove-modality')]
    public function remove($modalityId): void
    {
        $this->instructor->modalities()->detach($modalityId);
        $this->dispatch('modality-removed');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.instructor.instructor-modality-form');
    }
}
