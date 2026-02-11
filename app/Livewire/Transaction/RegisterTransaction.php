<?php

declare(strict_types=1);

namespace App\Livewire\Transaction;

use App\Enums\PaymentMethodEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class RegisterTransaction extends Component
{
    public Transaction $transaction;

    public $amount;

    public $paid_at;

    public $payment_method;

    public $comments;

    public function save()
    {
        $this->validate([
            'payment_method' => ['required'],
            'amount' => ['required'],
            'paid_at' => ['required']
        ]);

        $this->transaction->update([
            'payment_method' => $this->payment_method,
            'paid_at'        => Carbon::parse($this->paid_at),
            'amount'    => $this->amount,
            'status'         => 'payed',
            'comments' => $this->comments,
        ]);

        $this->dispatch('hide-modal', modal: 'modal-register-transaction');
        $this->dispatch('transaction-registered');
    }

    #[On('show-transaction')]
    public function show(Transaction $transaction)
    {

        $this->reset();
        $this->resetValidation();

        $this->transaction = $transaction;
        $this->amount    = currency($transaction->amountWithFee, prepend: false);
        $this->paid_at        = date('Y-m-d');
        $this->payment_method = null;

        $this->dispatch('show-modal', modal: 'modal-register-transaction');
    }

    #[On('cancel-transaction')]
    public function cancel(Transaction $transaction)
    {
        $transaction->update([
            'payment_method' => PaymentMethodEnum::PIX,
            'paid_at'        => null,
            'amount'    => $transaction->amount,
            'status'         => 'scheduled',
            'comments' => null,
            'payed' => 0,
        ]);
        $this->dispatch('transaction-registered');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.transaction.register-transaction');
    }
}
