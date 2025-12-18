<?php

declare(strict_types = 1);

namespace App\Livewire;

use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public string $message;

    public string $type = "success";

    public int $delay = 5000;

    public bool $show = false;

    #[On('show-alert')]
    public function show(string $message, string $type = "info"): void
    {
        $this->message = $message;
        $this->type    = $type;

        $this->show = true;
    }

    #[On('hide-alert')]
    public function hide(): void
    {
        $this->show = false;
    }

    public function render(): View | Closure | string
    {
        return view('livewire.alert');
    }
}
