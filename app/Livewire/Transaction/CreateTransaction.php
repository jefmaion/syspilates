<?php

declare(strict_types=1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateTransaction extends Component
{
    public $transaction;

    public $date;

    public $type;

    public $paid_amount;

    public $payed;

    public $description;

    public $student_id;

    public $comments;

    public $category_id;

    public $payment_method;

    public $repeat = null;

    public $repeat_times;

    #[On('create-transaction')]
    public function create()
    {
        $this->reset();
        $this->resetValidation();

        $this->date = now()->format('Y-m-d');

        $this->dispatch('show-modal', modal: 'modal-create-transaction');
    }

    #[On('edit-transaction')]
    public function edit($id)
    {
        $this->transaction = Transaction::find($id);

        $this->date           = $this->transaction->date->format('Y-m-d');
        $this->type           = $this->transaction->type;
        $this->paid_amount    = $this->transaction->paid_amount;
        $this->payed          = $this->transaction->payed;
        $this->description    = $this->transaction->description;
        $this->student_id     = $this->transaction->student_id;
        $this->comments       = $this->transaction->comments;
        $this->payment_method = $this->transaction->payment_method;
        $this->category_id    = $this->transaction->category_id;

        $this->dispatch('show-modal', modal: 'modal-create-transaction');
    }

    public function save()
    {
        $this->validate([
            'date'           => ['required'],
            'type'           => ['required'],
            'paid_amount'    => ['required'],
            'description'    => ['required'],
            'payment_method' => ['required'],
            'category_id' => ['required'],
        ]);

        $data           = $this->all();
        $data['amount'] = $this->paid_amount;


        if (! empty($this->transaction)) {
            $this->transaction->update($data);
            $this->transaction = null;
        } else {

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
                    $date['payed'] = 0;

                    Transaction::create($data);
                }
            }
        }

        $this->dispatch('hide-modal', modal: 'modal-create-transaction');
        $this->dispatch('transaction-created');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.transaction.create-transaction');
    }
}
