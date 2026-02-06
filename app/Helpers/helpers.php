<?php

declare(strict_types=1);

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
        $component->dispatch('show-alert', message: $message, type: $type);
    }
}

if (! function_exists('currency')) {
    function currency(float $value, $default = 0)
    {

        return 'R$ ' . number_format($value ?? $default, 2, ",", ".");
    }
}

if (!function_exists('initials')) {
    function initials($text)
    {
        $shortName = $text; // camelCase vira snake_case no acesso

        $parts    = explode(' ', $shortName);
        $initials = '';

        foreach ($parts as $p) {
            $initials .= strtoupper(substr($p, 0, 1));
        }

        return $initials;
    }
}
