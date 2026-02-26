<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;


new class extends Component
{
    /**
     * Log the current user out of the application.
     */


    public function theme($theme='light') {
        auth()->user()->update(['theme_mode' => $theme]);

        session(['theme' => [
            'mode' => $theme,
        ]]);

        $this->dispatch('theme-updated', theme: $theme);
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/login', navigate: true);
    }
}; ?>

@include('layouts.parts.navbar')