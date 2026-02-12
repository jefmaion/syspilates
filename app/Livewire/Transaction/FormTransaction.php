<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class FormTransaction extends Component
{

    public $transaction;

    public $date;

    public $type;

    public $amount;

    public $paid_at;

    public $payed;

    public $description;

    public $student_id;

    public $comments;

    public $category_id;

    public $payment_method;

    public $repeat = null;

    public $repeat_times;

    public $paid;

    #[On('create-transaction')]
    public function create()
    {
        $this->reset();
        $this->resetValidation();

        $this->date = now()->format('Y-m-d');

        $this->dispatch('show-modal', modal: 'modal-form-transaction');
    }

    #[On('edit-transaction')]
    public function edit($id)
    {
        $this->reset();
        $this->resetValidation();

        $this->transaction = Transaction::find($id);

        $this->date           = $this->transaction->date->format('Y-m-d');
        $this->type           = $this->transaction->type;
        $this->amount    = currency($this->transaction->amount, prepend: null);
        $this->paid_at          = $this->transaction->paid_at;
        $this->description    = $this->transaction->description;
        $this->student_id     = $this->transaction->student_id;
        $this->comments       = $this->transaction->comments;
        $this->payment_method = $this->transaction->payment_method;
        $this->category_id    = $this->transaction->category_id;
        $this->payed = $this->transaction->isPaid;

        $this->dispatch('show-modal', modal: 'modal-form-transaction');
    }

    public function prepareForValidation($attributes)
    {
        $attributes['amount'] = brlToUsd($attributes['amount']);
        return $attributes;
    }



    public function save()
    {
        $this->validate([
            'date'           => ['required'],
            'type'           => ['required'],
            'amount'    => ['required', 'numeric'],
            'description'    => ['required'],
            'payment_method' => ['required'],
            'category_id' => ['required'],
        ]);

        $data = [
            'date'           => $this->date,
            'type'           => $this->type,
            'amount'           =>   $this->amount,
            'description'    => $this->description,
            'student_id'     => $this->student_id,
            'comments'       => $this->comments,
            'payment_method' => $this->payment_method,
            'category_id'    => $this->category_id,
            'paid_at'        => ($this->paid) ? now() : null
        ];

        if (! empty($this->transaction)) {
            unset($data['paid_at']);
            $this->transaction->update($data);
        } else {

            $data['origin_amount'] = $data['amount'];

            $transaction = Transaction::create($data);

            if (!is_null($this->repeat) && !is_null($this->repeat_times)) {

                $_data = Carbon::parse($transaction->date);

                for ($i = 1; $i <= $this->repeat_times; $i++) {

                    switch ($this->repeat) {
                        case 'weekly':
                            $_data = $_data->copy()->addWeek();
                            break;

                        case 'biweekly':
                            $_data = $_data->copy()->addWeeks(2);
                            break;

                        case 'monthly':
                            $_data = $_data->copy()->addMonth();
                            break;
                    }

                    while ($_data->isWeekend()) {
                        $_data = $_data->addDay();
                    }


                    $data['date'] = $_data;
                    Transaction::create($data);
                }
            }
        }

        $this->transaction = null;
        $this->reset();

        $this->dispatch('hide-modal', modal: 'modal-form-transaction');
        $this->dispatch('transaction-created');
    }



    public function render(): View|Closure|string
    {
        return view('livewire.transaction.form-transaction');
    }
}
