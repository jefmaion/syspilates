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

    #[On('transaction-created')]
    public function mount()
    {
        $this->start = now()->startOfWeek()->format('Y-m-d');
        $this->end   = now()->endOfWeek()->format('Y-m-d');

        $this->label = ['start' => Carbon::parse($this->start)->format('d/m/y'), 'end' => Carbon::parse($this->end)->format('d/m/y')];
        $this->resetPage();
    }

    public function deleteTransaction($id)
    {
        $this->transaction = Transaction::find($id);
        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function delete()
    {
        $this->transaction->delete();
        $this->transaction = null;

        $this->dispatch('hide-modal', modal: 'modal-delete');
        $this->dispatch('$refresh');
    }

    protected function saldo()
    {
        return Transaction::getAmountBefore($this->start);
    }


    public function render(): View | Closure | string
    {
        $sums = Transaction::whereBetween('date', [$this->start, $this->end]);

        $box = [
            // ['label' => 'Receitas', 'icon' => 'primary', 'value' => Transaction::whereBetween('date', [$this->start, $this->end])->current('open')->sum('amount')],
            // ['label' => 'Despesas', 'icon' => 'success', 'value' => Transaction::whereBetween('date', [$this->start, $this->end])->current('payed')->sum('amount')],
            // ['label' => 'HOJE', 'icon' => 'warning', 'value' => Transaction::whereBetween('date', [$this->start, $this->end])->current('today')->sum('amount')],
            // ['label' => 'PRÓXIMOS RECEBIMENTOS', 'icon' => 'orange', 'value' => Transaction::whereBetween('date', [$this->start, $this->end])->current('soon')->sum('amount')],
            // ['label' => 'ATRASADOS', 'icon' => 'danger', 'value' => Transaction::whereBetween('date', [$this->start, $this->end])->current('late')->sum('amount')],
        ];

        $box = [
            'Agendados' => [
                'color' => 'primary',
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->where('payed', 0)->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->where('payed', 0)->where('type', 'D')->sum('amount'),
            ],
            'Vencem Hoje' => [
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
                'credit' => Transaction::whereBetween('date', [$this->start, $this->end])->where('payed', 1)->where('type', 'C')->sum('amount'),
                'debit' =>  Transaction::whereBetween('date', [$this->start, $this->end])->where('payed', 1)->where('type', 'D')->sum('amount'),
            ],
        ];



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


        $credit =  Transaction::whereBetween('date', [$this->start, $this->end])->where('payed', 1)->where('type', 'C')->sum('amount');
        $debit = Transaction::whereBetween('date', [$this->start, $this->end])->current('payed')->sum('amount');

        return view('livewire.transaction.transaction-page', [
            'transactions' => $transactions->paginate(10),
            'box'          => $box,
            'credit' => $credit,
            'debit' => $debit,
            'today' => Transaction::whereBetween('date', [$this->start, $this->end])->current('today')->sum('amount'),
            'sald' => $this->saldo(),
            'amount' => ($this->saldo() + $credit) - $debit
        ]);
    }
}
