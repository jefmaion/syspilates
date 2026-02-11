<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\PaymentMethodEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Registration;
use App\Models\Transaction;
use Carbon\Carbon;

class CreateRegistration
{
    public static function run(array $data)
    {
        $schedules = $data['schedule'] ?? null;
        unset($data['schedule']);

        $registration = Registration::create($data);

        $registration->schedule()->createMany($schedules);

        $registration = GenerateRegistrationClasses::run($registration, $registration->start, $registration->end);

        $duration = (int) ($registration->duration->value / 30);

        $date = Carbon::parse(date('Y-m-') . $registration->deadline);

        for ($i = 1; $i <= $duration; $i++) {
            Transaction::create([
                'registration_id' => $registration->id,
                'student_id'      => $registration->student_id,
                'date'            => $date->format('Y-m-d'),
                'amount'          => $registration->value,
                'origin_amount'     => $registration->value,
                'type'            => TransactionTypeEnum::CREDIT,
                'payment_method'  => null,
                'category_id'     => 1,
                'description'     => 'Mensalidade ' . $registration->modality->name . ' (' . $i . '/' . $duration . ')',
            ]);

            $date->addMonth(1);
        }

        return $registration;
    }
}
