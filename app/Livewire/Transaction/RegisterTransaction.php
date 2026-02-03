<?php

declare(strict_types = 1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class RegisterTransaction extends Component
{
    public Transaction $transaction;

    public $paid_amount;

    public $paid_at;

    public $payment_method;

    public function save()
    {
        $this->validate([
            'payment_method' => ['required'],
        ]);

        // dd('Salvando', $this->all());

        $this->transaction->update([
            'payment_method' => $this->payment_method,
            'paid_at'        => Carbon::parse($this->paid_at),
            'paid_amount'    => $this->paid_amount,
            'status'         => 'payed',
        ]);

        $this->dispatch('hide-modal', modal:'modal-register-transaction');
        $this->dispatch('transaction-registered');
    }

    #[On('show-transaction')]
    public function show(Transaction $transaction)
    {
        $this->transaction = $transaction;

        $this->paid_amount    = $transaction->amountWithFee;
        $this->paid_at        = date('Y-m-d');
        $this->payment_method = null;

        $this->dispatch('show-modal', modal:'modal-register-transaction');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.transaction.register-transaction');
    }
}
