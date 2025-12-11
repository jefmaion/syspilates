<?php

declare(strict_types = 1);

namespace App\Livewire\Modality;

use App\Models\Modality;
use App\Traits\PaginationTrait;
use Illuminate\View\View;
use Livewire\Component;

class ModalityPage extends Component
{
    use PaginationTrait;

    public function render(): View
    {
        return view('livewire.modality.modality-page', [
            'modalities' => Modality::whereLike('name', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate($this->pages),
        ]);
    }
}
