<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\CalculateComission;
use App\Actions\CreateMarkupClass;
use App\Actions\CreateRegistration;
use App\Enums\ClassStatusEnum;
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

        $plans  = [];
        $status = [];

        foreach (PlanEnum::cases() as $item) {
            $plans[] = $item->value;
        }

        foreach (ClassStatusEnum::cases() as $item) {
            if ($item->value == 'scheduled') {
                continue;
            }
            $status[] = $item->value;
        }

        for ($x = 1; $x <= 50; $x++) {
            $date         = fake()->dateTimeBetween('-1 months');
            $duration     = fake()->randomElements($plans)[0];
            $classPerWeek = rand(1, 3);

            $schedule = [];

            $exists = [];

            for ($i = 0; $i <= $classPerWeek; $i++) {
                $wd = rand(1, 6);

                while (in_array($wd, $exists)) {
                    $wd = rand(1, 6);
                }

                $schedule[] = [
                    'weekday'       => $wd,
                    'time'          => fake()->randomElements(array_keys($times->times))[0],
                    'instructor_id' => Instructor::inRandomOrder()->first()->id,
                ];

                $exists[] = $wd;
            }

            $registration = CreateRegistration::run([
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

            foreach ($registration->classes()->where('datetime', '<=', now())->orderBy('datetime', 'asc')->get() as $class) {
                $newStatus = $status[rand(0, (count($status) - 1))];

                if ($newStatus == 'scheduled') {
                    continue;
                }

                $class->update([
                    'status'    => $newStatus,
                    'evolution' => fake()->text(),
                ]);

                if ($newStatus == ClassStatusEnum::PRESENCE->value) {
                    CalculateComission::run($class);
                }

                if (in_array($newStatus, ['canceled', 'justified'])) {
                    CreateMarkupClass::run($class);
                }
            }
        }
    }
}
