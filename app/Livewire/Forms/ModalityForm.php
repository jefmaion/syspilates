<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\Modality;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ModalityForm extends Form
{
    public Modality $modality;

    public string $name;

    public string  $acronym;

    public function rules(): array
    {
        return [
            'name'    => ['required', Rule::unique('modalities', 'name')->ignore($this->modality?->id)],
            'acronym' => ['max:3'],
        ];
    }

    public function store(): void
    {
        $this->validate();

        session()->flash('success', 'Modalidade criada com sucesso!');

        Modality::create([
            'name'    => $this->name,
            'acronym' => $this->acronym,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        session()->flash('success', 'Modalidade alterada com sucesso!');

        $this->modality->update([
            'name'    => $this->name,
            'acronym' => $this->acronym,
        ]);
    }

    public function populate(?Modality $modality): void
    {
        $this->modality = $modality;

        $this->name    = $this->modality?->name;
        $this->acronym = $this->modality?->acronym;
    }
}
