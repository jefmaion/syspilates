<?php

declare(strict_types = 1);

if (! function_exists('messages')) {
    function messages($text, $type = 'success')
    {
        session()->flash($type, $text);
    }
}

function showModal($name)
{
}
