<?php

declare(strict_types = 1);

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class CashBook extends Component
{
    public function render(): View | Closure | string
    {
        $data   = [];
        $months = [
            1  => 'Janeiro',
            2  => 'Fevereiro',
            3  => 'Março',
            4  => 'Abril',
            5  => 'Maio',
            6  => 'Junho',
            7  => 'Julho',
            8  => 'Agosto',
            9  => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        for ($i = 1;$i <= 12;$i++) {
            $data[$months[$i]] = [
                'data' => Transaction::with('category')->whereMonth('date', $i)->whereYear('date', now())->orderBy('date')->get(),
                'd'    => Transaction::whereMonth('date', $i)->whereYear('date', now())->where('type', 'D')->sum('amount'),
                'c'    => Transaction::whereMonth('date', $i)->whereYear('date', now())->where('type', 'C')->sum('amount'),
            ];
        }

        return view('livewire.transaction.cash-book', [
            'transactions' => $data,
        ]);
    }
}
