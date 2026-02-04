<?php

declare(strict_types = 1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
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

    #[On('create-transaction')]
    public function create()
    {
        $this->reset();
        $this->resetValidation();

        $this->date = now()->format('Y-m-d');

        $this->dispatch('show-modal', modal:'modal-create-transaction');
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

        $this->dispatch('show-modal', modal:'modal-create-transaction');
    }

    public function save()
    {
        $this->validate([
            'date'           => ['required'],
            'type'           => ['required'],
            'paid_amount'    => ['required'],
            'description'    => ['required'],
            'payment_method' => ['required'],
        ]);

        $data           = $this->all();
        $data['amount'] = $this->paid_amount;

        if (! empty($this->transaction)) {
            $this->transaction->update($data);
            $this->transaction = null;
        } else {
            Transaction::create($data);
        }

        $this->dispatch('hide-modal', modal:'modal-create-transaction');
        $this->dispatch('transaction-created');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.transaction.create-transaction');
    }
}
