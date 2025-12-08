<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.parts.header')
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        <script data-navigate-track src="{{ asset('template/dist/js/tabler-theme.min.js') }}"></script>
        {{ $slot }}
        @include('layouts.parts.scripts')
    </body>
</html>
