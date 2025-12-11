<?php

declare(strict_types = 1);

use App\Livewire\Modality\CreateModality;
use App\Livewire\Modality\UpdateModality;
use App\Models\Modality;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateModality::class)
        ->assertStatus(200);
});

it('should be able to create a modality', function () {
    Livewire::test(CreateModality::class)
        ->set('form.name', 'Musculação')
        ->set('form.acronymn', 'MUS')
        ->call('save');

    expect(Modality::where('name', 'Musculação')->exists())->toBeTrue();
});

it('should be acronym max 3 characters', function () {
    Livewire::test(CreateModality::class)
        ->set('form.name', 'CrossFit')
        ->set('form.acronym', 'CROSS')
        ->call('save')
        ->assertHasErrors(['form.acronym' => 'max:3']);
});

it('should be update a modality', function () {
    $modality = Modality::factory()->create(['name' => 'Yoga']);

    Livewire::test(UpdateModality::class, ['modality' => $modality])
        ->set('form.name', 'Yoga')
        ->set('form.acronym', 'YG')
        ->call('save');

    expect($modality->refresh()->acronym)->toBe('YG');
});
