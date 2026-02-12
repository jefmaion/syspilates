<?php

namespace App\Livewire\Transaction;

use Closure;
use Livewire\Component;
use Illuminate\View\View;

class EditTransaction extends Component
{
    public function render() : View|Closure|string
    {
        return view('livewire.transaction.edit-transaction');
    }
}
