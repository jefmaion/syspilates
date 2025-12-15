<?php

declare(strict_types = 1);

use App\Livewire\Instructor\InstructorModalityForm;
use App\Models\Instructor;
use App\Models\Modality;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('can add a modality to an instructor with commission settings', function () {
    $instructor = Instructor::factory()->create();
    $modality   = Modality::factory()->create();

    Livewire::test(InstructorModalityForm::class, ['instructor' => $instructor])
        ->set('modality_id', $modality->id)
        ->set('commission_type', 'percent')
        ->set('commission_value', 12.5)
        ->set('calculate_on_justified_absence', true)
        ->call('add')
        ->assertStatus(200);

    $this->assertDatabaseHas('instructor_modality', [
        'instructor_id'                  => $instructor->id,
        'modality_id'                    => $modality->id,
        'commission_type'                => 'percent',
        'commission_value'               => 12.5,
        'calculate_on_justified_absence' => true,
    ]);
});

it('can remove a modality from an instructor', function () {
    $instructor = Instructor::factory()->create();
    $modality   = Modality::factory()->create();

    // cria vínculo inicial
    $instructor->modalities()->attach($modality->id, [
        'commission_type'                => 'fixed',
        'commission_value'               => 50,
        'calculate_on_justified_absence' => false,
    ]);

    Livewire::test(InstructorModalityForm::class, ['instructor' => $instructor])
        ->call('remove', $modality->id)
        ->assertStatus(200);

    $this->assertDatabaseMissing('instructor_modality', [
        'instructor_id' => $instructor->id,
        'modality_id'   => $modality->id,
    ]);
});

it('lists all modalities for an instructor', function () {
    $instructor = Instructor::factory()->create();
    $modalities = Modality::factory()->count(3)->create();

    foreach ($modalities as $modality) {
        $instructor->modalities()->attach($modality->id, [
            'commission_type'                => 'percent',
            'commission_value'               => 10,
            'calculate_on_justified_absence' => false,
        ]);
    }

    $instructor->refresh();

    expect($instructor->modalities)->toHaveCount(3);

    expect($instructor->modalities->pluck('id')->toArray())
        ->toContain($modalities[0]->id)
        ->toContain($modalities[1]->id)
        ->toContain($modalities[2]->id);
});

it('lists all instructors for a modality', function () {
    $modality    = Modality::factory()->create();
    $instructors = Instructor::factory()->count(3)->create();

    foreach ($instructors as $instructor) {
        $instructor->modalities()->attach($modality->id, [
            'commission_type'                => 'fixed',
            'commission_value'               => 50,
            'calculate_on_justified_absence' => true,
        ]);
    }

    expect($modality->instructors)->toHaveCount(3);

    expect($modality->instructors->pluck('id')->toArray())
        ->toContain($instructors[0]->id)
        ->toContain($instructors[1]->id)
        ->toContain($instructors[2]->id);
});

it('can edit a modality attached to an instructor', function () {
    $instructor = Instructor::factory()->create();
    $modality   = Modality::factory()->create();

    // cria vínculo inicial
    $instructor->modalities()->attach($modality->id, [
        'commission_type'                => 'percent',
        'commission_value'               => 10,
        'calculate_on_justified_absence' => false,
    ]);

    // atualiza os dados da pivot
    $instructor->modalities()->updateExistingPivot($modality->id, [
        'commission_type'                => 'fixed',
        'commission_value'               => 76,
        'calculate_on_justified_absence' => true,
    ]);

    $instructor->refresh();

    // recarrega
    $pivot = $instructor->modalities()->first()->pivot;

    expect($pivot->commission_type)->toBe('fixed');
    expect($pivot->commission_value)->toBe(76);
    expect($pivot->calculate_on_justified_absence)->toBe(1);
});

it('can detach a modality from an instructor', function () {
    $instructor = Instructor::factory()->create();
    $modality   = Modality::factory()->create();

    // cria vínculo inicial
    $instructor->modalities()->attach($modality->id, [
        'commission_type'                => 'percent',
        'commission_value'               => 20,
        'calculate_on_justified_absence' => false,
    ]);

    // remove
    $instructor->modalities()->detach($modality->id);

    // valida
    $this->assertDatabaseMissing('instructor_modality', [
        'instructor_id' => $instructor->id,
        'modality_id'   => $modality->id,
    ]);
});

it('does not allow duplicate modalities for the same instructor', function () {
    $instructor = Instructor::factory()->create();
    $modality   = Modality::factory()->create();

    // primeira vez funciona
    $instructor->modalities()->attach($modality->id, [
        'commission_type'                => 'percent',
        'commission_value'               => 10,
        'calculate_on_justified_absence' => false,
    ]);

    // segunda vez deve falhar
    expect(function () use ($instructor, $modality) {
        $instructor->modalities()->attach($modality->id, [
            'commission_type'                => 'percent',
            'commission_value'               => 10,
            'calculate_on_justified_absence' => false,
        ]);
    })->toThrow(QueryException::class);

    // garante que só existe 1 registro
    $this->assertDatabaseCount('instructor_modality', 1);
});
