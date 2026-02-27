<?php

namespace App\Livewire\Dashboard\Charts;

use App\Models\Transaction;
use Closure;
use Livewire\Component;
use Illuminate\View\View;

class Expenses extends Component
{

    public $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'];
    public $credit;
    public $debit;

    public function mount()
    {
        $data = Transaction::selectRaw("
            MONTH(date) as month,
            SUM(CASE WHEN type = 'C' THEN amount ELSE 0 END) as credit,
            SUM(CASE WHEN type = 'D' THEN amount ELSE 0 END) as debit
        ")
            ->whereNotNull('paid_at')
            ->whereYear('date', 2026)
            ->groupBy('month')
            ->orderBy('month')->get();

        $this->months = $data->pluck('month')->map(fn($m) => date("M", mktime(0, 0, 0, $m, 1)));
        $this->credit = $data->pluck('credit');
        $this->debit = $data->pluck('debit');
    }

    public function render(): View|Closure|string
    {
        return view('livewire.dashboard.charts.expenses');
    }
}
