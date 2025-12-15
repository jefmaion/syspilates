<?php

declare(strict_types = 1);

if (! function_exists('messages')) {
    function messages(string $text, string $type = 'success'): void
    {
        session()->flash($type, $text);
    }
}
