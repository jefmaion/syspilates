<?php

declare(strict_types=1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionPage extends Component
{
    use WithPagination;

    public $start;

    public $end;

    public $label;

    public $status;

    public $transaction;

    public $search;

    public $filter = [];

    public $deleteText;



    #[On('transaction-created')]
    public function mount()
    {
        $this->start = now()->startOfWeek()->format('Y-m-d');
        $this->end   = now()->endOfWeek()->format('Y-m-d');

        $this->label = ['start' => Carbon::parse($this->start)->format('d/m/y'), 'end' => Carbon::parse($this->end)->format('d/m/y')];
        $this->resetPage();
    }

    public function create()
    {
        $this->resetValidation();
        $this->dispatch('create-transaction');
    }

    public function deleteTransaction($id)
    {
        $this->deleteText = null;
        $this->transaction = Transaction::find($id);

        if ($this->transaction->comissions->count()) {
            $this->deleteText = "As comissões deverão ser geradas novamente!";
        }

        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function updated($property, $value)
    {

        if (in_array($property, ['start', 'end', 'type', 'student_id', 'description', 'student_id', 'type'])) {
            $this->resetPage();
        }
    }

    public function delete()
    {
        if ($this->transaction->comissions) {
            $this->transaction->comissions()->update(['transaction_id' => null]);
        }

        $this->transaction->delete();

        $this->transaction = null;

        $this->dispatch('hide-modal', modal: 'modal-delete');
        $this->dispatch('$refresh');
    }

    public function pay($id)
    {
        $this->dispatch('pay-transaction', id: $id);
    }

    protected function saldo()
    {
        return Transaction::getAmountBefore($this->start);
    }


    public function render(): View | Closure | string
    {
        $box = [
            'Em Aberto' => [
                'color' => 'primary',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->whereNull('paid_at')->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->whereNull('paid_at')->where('type', 'D')->sum('amount'),
            ],
            'Pagar/Receber Hoje' => [
                'color' => 'warning',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->current('today')->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->current('today')->where('type', 'D')->sum('amount'),
            ],
            'Atrasados' => [
                'color' => 'danger',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->current('late')->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->current('late')->where('type', 'D')->sum('amount'),
            ],
            'Próximos Venctos.' => [
                'color' => 'info',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->current('soon')->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->current('soon')->where('type', 'D')->sum('amount'),
            ],
            'Recebidos/Pagos' => [
                'color' => 'green',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->whereNotNull('paid_at')->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->whereNotNull('paid_at')->where('type', 'D')->sum('amount'),
            ],
        ];


        $credit =  Transaction::whereBetween('date', [$this->start, $this->end])->whereNotNull('paid_at')->where('type', 'C')->sum('amount');
        $debit = Transaction::whereBetween('date', [$this->start, $this->end])->current('payed')->sum('amount');


        // $this->resetPage();
        return view('livewire.transaction.transaction-page', [
            'transactions' => $this->filters()->paginate(10),
            'box'          => $box,
            'credit' => $credit,
            'debit' => $debit,
            'today' => Transaction::whereBetween('date', [$this->start, $this->end])->current('today')->sum('amount'),
            'sald' => $this->saldo(),
            'amount' => ($this->saldo() + $credit) - $debit
        ]);
    }

    public function filters()
    {

        $transactions = Transaction::with(['student.user', 'category'])->whereBetween('date', [$this->start, $this->end])->orderBy('created_at', 'desc');

        foreach ($this->filter as $key => $value) {
            if ($key == 'status') {
                $transactions->when($value, fn($q) => $q->current($value));
                continue;
            }

            $transactions->whereLike($key, '%' . $value . '%');
        }

        if ($this->search) {
            $transactions->whereLike('description', '%' . $this->search . '%');
        }

        return $transactions;
    }
}
