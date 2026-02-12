<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class PayTransaction extends Component
{

    public $transaction;

    public $amount;
    public $paid_at;
    public $payment_method;
    public $comments;

    #[On('pay-transaction')]
    public function show($id)
    {

        $this->transaction = Transaction::find($id);

        $this->amount =  currency($this->transaction->amountWithFee);
        $this->paid_at = $this->transaction->date->format('Y-m-d');
        $this->payment_method = $this->transaction->payment_method;
        $this->comments = $this->transaction->comments;


        // if ($this->transaction->category_id == 1 && $this->transaction->daysLate > 0) {
        //     $this->amount = currency($this->transaction->amountWithFee);
        // }

        $this->dispatch('show-modal', modal: 'modal-pay-transaction');
    }

    public function save()
    {

        $this->validate([
            'amount' => ['required'],
            'payment_method' => ['required'],
        ]);

        $this->transaction->update([
            'amount' => $this->amount,
            'paid_at' => $this->paid_at,
            'payment_method' => $this->payment_method,
            'comments' => $this->comments
        ]);

        $this->dispatch('hide-modal', modal: 'modal-pay-transaction');
        $this->dispatch('transaction-created');
        $this->dispatch('transaction-registered');
    }

    public function render(): View|Closure|string
    {
        return view('livewire.transaction.pay-transaction');
    }
}
