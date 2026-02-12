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
use Livewire\WithPagination;

class ComissionPage extends Component
{

    use WithPagination;

    public $start;
    public $end;

    public $instructor_id;


    public $date;
    public $payment_method;


    public $comments;
    public $category_id;

    public $payed = null;

    public $toPay;

    public $payStart;
    public $payEnd;
    public $instructor;
    public $amount;
    public $count;


    public function mount()
    {
        $this->start = now()->startOfMonth()->format('Y-m-d');
        $this->end = now()->endOfMonth()->format('Y-m-d');
    }

    public function calculate()
    {
        $this->payStart = Carbon::parse($this->start);
        $this->payEnd = Carbon::parse($this->end);

        $this->resetPage();
    }

    public function createComissionTransaction()
    {

        $this->reset('payment_method', 'category_id', 'comments', 'payed');

        $this->date = now()->format('Y-m-d');

        $this->count =  InstructorComission::whereBetween('datetime', [$this->start, $this->end])->where('instructor_id', $this->instructor->id)->whereNull('transaction_id')->count();

        $this->amount = InstructorComission::whereBetween('datetime', [$this->start, $this->end])->where('instructor_id', $this->instructor->id)->whereNull('transaction_id')->sum('value');

        $this->dispatch('show-modal', modal: "modal-pay");
    }

    public function generatePayment()
    {

        $this->validate([
            'date' => ['required'],
            'payment_method' => ['required'],
            'category_id' => ['required'],
        ]);

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
    }

    public function render(): View|Closure|string
    {

        $comiss = InstructorComission::with('instructor.user')
            ->with('class.student.user')
            ->with('class.modality')
            ->with('transaction')
            ->whereBetween('datetime', [$this->start, $this->end])
            ->whereNull('transaction_id')
            ->where('instructor_id', $this->instructor_id)
            ->orderBy('datetime', 'desc');

        $this->amount = InstructorComission::with('instructor.user')
            ->whereBetween('datetime', [$this->start, $this->end])
            ->whereNull('transaction_id')
            ->where('instructor_id', $this->instructor_id)->sum('value');

        $this->instructor = Instructor::with('user')->find($this->instructor_id);

        return view('livewire.transaction.comission-page', [
            'comissions' => $comiss->paginate(8),
        ]);
    }
}
