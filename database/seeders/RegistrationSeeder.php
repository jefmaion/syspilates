<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Actions\CreateRegistration;
use App\Enums\PlanEnum;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use App\View\Components\Form\SelectTime;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Registration::factory(5)->create();

        $times = new SelectTime();

        $plans = [];

        foreach (PlanEnum::cases() as $item) {
            $plans[] = $item->value;
        }

        for ($x = 1; $x <= 50; $x++) {
            $date         = fake()->dateTimeBetween('-1 months');
            $duration     = fake()->randomElements($plans)[0];
            $classPerWeek = rand(1, 3);

            $schedule = [];

            for ($i = 0; $i <= $classPerWeek; $i++) {
                $schedule[] = [
                    'weekday'       => rand(0, 6),
                    'time'          => fake()->randomElements(array_keys($times->times))[0],
                    'instructor_id' => Instructor::inRandomOrder()->first()->id,
                ];
            }

            CreateRegistration::run([
                'student_id'     => Student::inRandomOrder()->first()->id,
                'modality_id'    => Modality::inRandomOrder()->first()->id,
                'duration'       => $duration,
                'class_per_week' => $classPerWeek,
                'value'          => fake()->randomFloat(2, 0, 500),
                'deadline'       => rand(1, 28),
                'start'          => $date,
                'end'            => Carbon::parse($date)->addDays($duration)->format('Y-m-d'),
                'status'         => 'active',
                'schedule'       => $schedule,
            ]);
        }
    }
}
