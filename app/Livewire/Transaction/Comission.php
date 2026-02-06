<?php

namespace App\Livewire\Transaction;

use App\Enums\TransactionTypeEnum;
use App\Models\Instructor;
use App\Models\InstructorComission;
use App\Models\Transaction;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class Comission extends Component
{

    public $start;
    public $end;
    public $instructor_id;

    public $comissions = [];
    public $amount;


    public function mount() {}

    #[On('calculate-comission')]
    public function open()
    {
        $this->start = now()->startOfMonth()->format('Y-m-d');
        $this->end = now()->endOfMonth()->format('Y-m-d');

        $this->dispatch('show-modal', modal: 'modal-create-comission');
    }

    public function calculate()
    {
        $this->comissions = InstructorComission::whereBetween('datetime', [$this->start, $this->end])->where('instructor_id', $this->instructor_id)->whereNull('transaction_id')->get();
        $this->amount = InstructorComission::whereBetween('datetime', [$this->start, $this->end])->where('instructor_id', $this->instructor_id)->whereNull('transaction_id')->sum('value');
    }

    public function save()
    {

        $instructor = Instructor::with('user')->find($this->instructor_id);

        $transaction = Transaction::create([
            'date'            => now()->format('Y-m-d'),
            'amount'          => $this->amount,
            'paid_amount'     => $this->amount,
            'type'            => TransactionTypeEnum::DEBIT,
            'category_id'     => 1,
            'description'     => 'Comissão  de ' . $instructor->user->shortName . ' (' . $this->start . '/' . $this->end . ')',
        ]);

        foreach ($this->comissions as $comiss) {
            $comiss->update(['transaction_id' => $transaction->id]);
        }

        $this->dispatch('hide-modal', modal: 'modal-create-comission');
    }

    public function render(): View|Closure|string
    {
        return view('livewire.transaction.comission');
    }
}
