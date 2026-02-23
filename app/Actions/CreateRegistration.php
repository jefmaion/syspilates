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
    public static function run(array $data, bool $firstPay = false)
    {
        $schedules = $data['schedule'] ?? null;
        unset($data['schedule']);

        $registration = Registration::create($data);

        $registration->schedule()->createMany($schedules);

        $registration = GenerateRegistrationClasses::run($registration, $registration->start, $registration->end);

        $duration = (int) ($registration->duration->value / 30);

        $date = Carbon::parse($registration->start->format('Y'), $registration->start->format('m'), $registration->deadline);

        $firstDueDate = $date->copy();

        for ($i = 1; $i <= $duration; $i++) {

            $payed = null;

            if ($i == 1 && $firstPay) {
                $payed = $registration->start;
            }

            if ($date->isSaturday()) {
                $date->addDays(2);
            }

            if ($date->isSunday()) {
                $date->addDays(1);
            }

            $last = Transaction::create([
                'category_id'     => 1,
                'payment_method'  => null,
                'registration_id' => $registration->id,
                'student_id'      => $registration->student_id,
                'date'            => $date->format('Y-m-d'),
                'amount'          => $registration->value,
                'origin_amount'   => $registration->value,
                'type'            => TransactionTypeEnum::CREDIT,
                'description'     => 'Mensalidade ' . $registration->modality->name . ' (' . $i . '/' . $duration . ')',
                'paid_at' => $payed,
                'reference_type' => 'installment'
            ]);

            $date->addMonth();
        }


        $date = $last->date;
        if ($firstDueDate->lte($registration->start)) {
            $date = $last->date->addMonth();
        }

        $registration->update(['date_expiration' => $date]);

        return $registration;
    }
}
