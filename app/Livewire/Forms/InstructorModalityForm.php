<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\Instructor;
use Illuminate\Validation\Rule;
use Livewire\Form;

class InstructorModalityForm extends Form
{
    public Instructor $instructor;

    public ?int $modality_id = null;

    public string $commission_type = 'percent';

    public ?float  $commission_value = null;

    public bool $calculate_on_justified_absence = true;

    public bool $edit = false;

    public function resetFields(): void
    {
        $this->reset('modality_id', 'commission_type', 'commission_value', 'calculate_on_justified_absence');
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $rule = Rule::unique('instructor_modality', 'modality_id')
            ->where('instructor_id', $this->instructor->id);

        // Se estiver editando, ignora o próprio registro
        if ($this->edit) {
            $rule->ignore($this->modality_id, 'modality_id');
        }

        return [
            'modality_id'                    => ['required', 'exists:modalities,id', $rule],
            'commission_type'                => ['required', 'in:percent,fixed'],
            'commission_value'               => ['required', 'numeric', 'min:0'],
            'calculate_on_justified_absence' => ['boolean'],
        ];
    }

    public function selectModalityToEdit(int $modalityId): void
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

        $this->resetValidation();
    }

    public function add(): void
    {
        $this->validate();

        $this->instructor->modalities()->attach($this->modality_id, [
            'commission_type'                => $this->commission_type,
            'commission_value'               => $this->commission_value,
            'calculate_on_justified_absence' => $this->calculate_on_justified_absence,
        ]);

        $this->resetFields();
    }

    public function update(): void
    {
        $this->validate();

        $this->instructor->modalities()->updateExistingPivot($this->modality_id, [
            'commission_type'                => $this->commission_type,
            'commission_value'               => $this->commission_value,
            'calculate_on_justified_absence' => $this->calculate_on_justified_absence,
        ]);
    }
}
