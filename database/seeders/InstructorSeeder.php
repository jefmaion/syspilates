<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::factory(5)->withModalities(1)->create();


        foreach (Instructor::with('user.roles')->get() as $instructor) {
            $instructor->user->assignRole('Professor');
        }


        $user  = User::factory()->create([
            'name'  => 'Professor',
            'email' => 'prof@prof.com',
        ])->assignRole(['Professor']);

        Instructor::create([
            'user_id'    => $user->id,
            'profession' => fake()->randomElements(['Fisioterapeuta', 'Educador(a) Físico', 'Osteopata'])[0],
            'document'   => fake()->randomElements(['CRM', 'CRO', 'CREFITO'])[0] . '-' . fake()->numberBetween(100000, 999999),
            'comments'   => fake()->sentence(20),
        ]);
    }
}
