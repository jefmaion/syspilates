<?php

declare(strict_types = 1);

namespace App\Livewire\Layout;

use Illuminate\View\View;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * @var array<string, array<string, mixed>>
     */
    public array $sidebarMenu = [];

    /**
     * @param array<string, array<string, mixed>> $items
     * @return array<string, array<string, mixed>>
     */
    private function parse(array $items = []): array
    {
        foreach ($items as $title => &$item) {
            if ($item == 'nav-header') {
                continue;
            }

            // marca ativo
            $item['active'] = ! empty($item['route']) ? request()->routeIs($item['route'] . '*') : false;
            $item['show']   = false;

            // se tiver submenu, processa recursivamente
            if (isset($item['submenu'])) {
                $item['submenu'] = $this->parse($item['submenu']);
                $item['show']    = collect($item['submenu'])->contains(fn ($sub) => $sub['active'] || ($sub['show'] ?? false));
                $item['active']  = $item['show'];
            }
        }

        return $items;
    }

    public function mount(): void
    {
        $this->sidebarMenu = $this->parse(config('tabler.sidebar-menu'));

        // dd($this->sidebarMenu);
    }

    public function render(): View
    {
        return view('livewire.layout.sidebar');
    }
}
