<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }} -  @yield('title')</title>
<link href="{{ asset('template/dist/css/tabler.css') }}" rel="stylesheet" />
<link href="{{ asset('template/dist/css/tabler-themes.css?1744816591') }}" rel="stylesheet" />
<link href="{{ asset('template/preview/css/demo.css?1744816591') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    @import url("https://rsms.me/inter/inter.css");
</style>
<style>
  @media (min-width: 992px) {

    :host,
    :root {
      margin-left: 0;
    }
  }

  body {
    overflow-y: scroll;
  }
</style>
<script data-navigate-track src="{{ asset('template/dist/js/tabler.js') }}?{{ date('i') }}"></script>

@yield('header')

