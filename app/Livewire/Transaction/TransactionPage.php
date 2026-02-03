<?php

declare(strict_types = 1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Closure;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionPage extends Component
{
    use WithPagination;

    public $start;

    public $end;

    public function mount()
    {
        $this->start = now()->startOfMonth()->format('Y-m-d');
        $this->end   = now()->endOfMonth()->format('Y-m-d');
        $this->resetPage();
    }

    public function render(): View | Closure | string
    {
        return view('livewire.transaction.transaction-page', [
            'transactions' => Transaction::with('student.user')->whereBetween('date', [$this->start, $this->end])->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
