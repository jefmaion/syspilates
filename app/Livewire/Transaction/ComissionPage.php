<?php

namespace App\Livewire\Transaction;

use App\Enums\TransactionTypeEnum;
use App\Models\Instructor;
use App\Models\InstructorComission;
use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class ComissionPage extends Component
{

    public $start;
    public $end;
    public $instructor_id;

    public $comissions = [];
    public $amount;
    public $date;
    public $payment_method;

    public $instructor;

    public $comments;
    public $category_id;

    public $payed = null;

    public function mount()
    {
        $this->start = now()->startOfMonth()->format('Y-m-d');
        $this->end = now()->endOfMonth()->format('Y-m-d');

        $this->calculate();
    }

    public function calculate()
    {
        $comissions = InstructorComission::selectRaw('instructor_id,  COUNT(*) as total_class, SUM(value) as total')
            ->with('instructor.user')
            ->whereBetween('datetime', [$this->start, $this->end])
            ->whereNull('transaction_id')
            ->groupBy('instructor_id');

        if ($this->instructor_id) {
            $comissions->where('instructor_id', $this->instructor_id);
        }

        $this->comissions = $comissions->get();
    }

    public function createComissionTransaction($instructor_id)
    {

        $this->calculate();

        $this->instructor = Instructor::with('user')->find($instructor_id);
        $this->date = now()->format('Y-m-d');
        $this->amount = InstructorComission::whereBetween('datetime', [$this->start, $this->end])->where('instructor_id', $instructor_id)->whereNull('transaction_id')->sum('value');

        $this->dispatch('show-modal', modal: "modal-pay");
    }

    public function generatePayment()
    {
        $transaction = Transaction::create([
            'date'            => $this->date,
            'amount'          => $this->amount,
            'origin_amount'     => $this->amount,
            'paid_at' => ($this->payed) ? $this->date : null,
            'comments' => $this->comments,
            'type'            => TransactionTypeEnum::DEBIT,
            'category_id'     => $this->category_id,
            'description'     => 'Pagamento de Aulas - ' . $this->instructor->user->shortName . ' - (' . Carbon::parse($this->start)->format('d/m/y') . ' à ' . Carbon::parse($this->end)->format('d/m/y') . ')',
        ]);

        InstructorComission::whereBetween('datetime', [$this->start, $this->end])
            ->where('instructor_id', $this->instructor->id)
            ->whereNull('transaction_id')
            ->update(['transaction_id' => $transaction->id]);

        $this->dispatch('hide-modal', modal: "modal-pay");
        $this->calculate();
    }

    public function render(): View|Closure|string
    {
        return view('livewire.transaction.comission-page');
    }
}
