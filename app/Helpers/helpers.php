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
    function currency($value, $default = 0, $prepend = "")
    {

        return $prepend . number_format((float) $value ?? $default, 2, ",", ".");
    }
}

if (! function_exists('brlToUsd')) {
    function brlToUsd($value)
    {
        if (strpos((string) $value, ',') === false) return $value;

        return str_replace(",", ".", str_replace(".", "", (string) $value));
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
