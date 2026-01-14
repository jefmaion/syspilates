<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\Modality;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ModalityForm extends Form
{
    public ?Modality $modality = null;

    public string $name = '';

    public ?string  $acronym = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'max:100', Rule::unique('modalities', 'name')->ignore($this->modality?->id)],
            'acronym' => ['max:3'],
        ];
    }

    public function store(): void
    {
        $this->validate();

        Modality::create([
            'name'    => $this->name,
            'acronym' => $this->acronym,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $this->modality->update([
            'name'    => $this->name,
            'acronym' => $this->acronym,
        ]);
    }

    public function populate(?Modality $modality): void
    {
        $this->modality = $modality;

        $this->name    = $this->modality->name ?? '';
        $this->acronym = $this->modality->acronym ?? '';
    }
}
