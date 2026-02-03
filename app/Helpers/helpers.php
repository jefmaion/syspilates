<?php

declare(strict_types = 1);

use Livewire\Component;

if (! function_exists('messages')) {
    function messages(string $text, string $type = 'success'): void
    {
        session()->flash($type, $text);
    }
}

if (! function_exists('lw_alert')) {
    function lw_alert(Component $component, string $message, string $type = 'info')
    {
        $component->dispatch('show-alert', message: $message, type:$type);
    }
}

if (! function_exists('currency')) {
    function currency(float $value, $default = null)
    {
        return 'R$ ' . number_format($value ?? $default, 2, ",", ".");
    }
}
