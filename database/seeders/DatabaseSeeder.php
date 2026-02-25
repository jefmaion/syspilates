<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleAndPermissionsSeeder::class,
            ModalitySeeder::class,
            PlanSeeder::class,
            StudentSeeder::class,
            InstructorSeeder::class,
            RegistrationSeeder::class,
            RegistrationPlanSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
        ]);

        User::factory()->create([
            'name'  => 'Administrator',
            'email' => 'admin@admin.com',
        ])->assignRole('Administrador');

        User::factory()->create([
            'name'  => 'professor',
            'email' => 'prof@prof.com',
        ])->assignRole('Professor');

        User::factory()->create([
            'name'  => 'Aluno',
            'email' => 'aluno@aluno.com',
        ])->assignRole('Aluno');
    }
}
