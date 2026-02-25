<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PlanForm extends Form
{
    public ?Plan $plan = null;

    public $name = '';
    public $duration;
    public $classes_per_week;
    public $value;

    public function prepareForValidation($attributes)
    {
        $attributes['value'] = brlToUsd($attributes['value']);
        return $attributes;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'max:100', Rule::unique('plans', 'name')->ignore($this->plan?->id)],
            'duration' => ['required', 'numeric'],
            'classes_per_week' => ['required', 'numeric'],
            'value' => ['required'],
        ];
    }

    public function save()
    {
        if ($this->plan) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store(): Plan
    {
        $data = $this->validate();
        return   Plan::create($data);
    }

    public function update(): void
    {
        $data = $this->validate();
        $this->plan->update($data);
    }

    public function populate(?Plan $plan): void
    {
        $this->plan = $plan;

        $this->name = $this->plan->name ?? null;
        $this->duration = $this->plan->duration ?? null;
        $this->classes_per_week = $this->plan->classes_per_week ?? null;
        $this->value = $this->plan->value ?? null;
    }
}
