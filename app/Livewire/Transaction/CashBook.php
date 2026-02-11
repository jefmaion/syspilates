<?php

declare(strict_types=1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CashBook extends Component
{

    use WithPagination;

    public $month;
    public $year;

    public $category_id;

    public $search;

    public $months = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ];

    public function mount()
    {
        $this->month = date('n');
        $this->year = date('Y');
    }

    protected function baseQuery()
    {
        return Transaction::with('category')->whereNotNull('paid_at')->whereMonth('date', $this->month)->whereYear('date', $this->year);
    }

    protected function saldo()
    {
        return Transaction::getAmountBefore($this->year . '-' . $this->month . '-01');
    }

    protected function totalsByType(): array
    {
        return $this->baseQuery()->select('type', DB::raw('SUM(amount) as total'))->groupBy('type')->pluck('total', 'type')->toArray();
    }
    protected function totalsByCategory(): array
    {
        return $this->baseQuery()->select('category_id', 'type', DB::raw('SUM(amount) as total'))->groupBy('category_id', 'type')->with('category')->get()->groupBy('category.name')->map(function ($items) {
            return ['D' => $items->where('type', 'D')->sum('total'), 'C' => $items->where('type', 'C')->sum('total'),];
        })->toArray();
    }
    protected function transactions()
    {
        return $this->baseQuery()->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))->when($this->search, fn($q) => $q->where('description', 'like', "%{$this->search}%"))->orderBy('date', 'desc')->paginate(10);
    }

    protected function totalsByMonth($month)
    {

        if ($month <= 0) return;

        return Transaction::select('type', DB::raw('SUM(amount) as total'))
            ->whereNull('paid_at')
            ->whereMonth('date', $month)
            ->whereYear('date', $this->year)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();
    }

    protected function indicators(): array
    {
        $current = $this->totalsByMonth($this->month);
        $previous = $this->totalsByMonth($this->month - 1);

        $debitCurrent  = $current['D'] ?? 0;
        $creditCurrent = $current['C'] ?? 0;

        $debitPrev  = $previous['D'] ?? 0;
        $creditPrev = $previous['C'] ?? 0;

        return [
            'debit'  => $debitPrev > 0 ? (($debitCurrent - $debitPrev) / $debitPrev) * 100 : null,
            'credit' => $creditPrev > 0 ? (($creditCurrent - $creditPrev) / $creditPrev) * 100 : null,
        ];
    }


    public function render(): View
    {
        $totals = $this->totalsByType();
        $transactions = $this->transactions();
        $debit = $totals['D'] ?? 0;
        $credit = $totals['C'] ?? 0;
        $saldo = $this->saldo();
        $amount = ($saldo + $credit) - $debit;

        $transactions->transform(function ($item) use (&$saldo) {
            if ($item->type->value == 'D') {
                $saldo -=  $item->amount;
            } else {
                $saldo += $item->amount;
            }

            $item->apos = $saldo;

            return $item;
        });

        $sald = $this->saldo();

        return view('livewire.transaction.cash-book', [
            'monthName' => $this->months[$this->month],
            'transactions' => $transactions,
            'debit' => $debit,
            'credit' => $credit,
            'amount' => $amount,
            'categories' => $this->totalsByCategory(),
            'indicators' => $this->indicators(),
            'sald' => $sald,
            'share' => $sald != 0 ? round((($amount - $sald) / $sald ?? 0) * 100, 1) : 0
        ]);
    }
}
