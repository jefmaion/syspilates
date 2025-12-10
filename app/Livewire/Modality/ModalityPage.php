<?php

declare(strict_types = 1);

namespace App\Livewire\Modality;

use App\Models\Modality;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ModalityPage extends Component
{
    use WithPagination;

    public string $search;

    public int $pages = 3;

    public function render(): View
    {
        return view('livewire.modality.modality-page', [
            'modalities' => Modality::whereLike('name', '%' . $this->search . '%')->paginate($this->pages),
        ]);
    }
}
