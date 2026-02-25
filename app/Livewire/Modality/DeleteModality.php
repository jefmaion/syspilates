<?php

declare(strict_types=1);

namespace App\Livewire\Modality;

use App\Models\Modality;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

class DeleteModality extends Component
{
    public Modality $modality;

    #[On('delete-modality')]
    public function select(Modality $modality): Event
    {
        $this->modality = $modality;
        return $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function delete(): void
    {
        if ($this->modality->classes()->count() > 0) {
            lw_alert($this, 'Não é possível excluir essa modalidade. Existem aulas/matrículas relacionadas à ela.', 'warning');
            return;
        }
        $this->modality->delete();
        session()->flash('info', 'Modalidade excluída com sucesso!');
        $this->redirect(route('modality'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.modality.delete-modality');
    }
}
