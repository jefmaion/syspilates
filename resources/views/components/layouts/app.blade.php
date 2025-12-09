<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.parts.header')
    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body>
    @include('layouts.parts.theme')
    <div class="page">
        <!--  BEGIN SIDEBAR  -->
        @include('layouts.parts.sidebar')
        <!--  END SIDEBAR  -->

        <!-- BEGIN NAVBAR  -->
        <livewire:layout.navigation />
        <!-- END NAVBAR  -->

        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->
            @if(isset($header))
            <div class="page-header d-print-none">
                <div class="container-fluid">
                    {{$header}}
                </div>
            </div>
            @endif
            <!-- END PAGE HEADER -->

            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <!-- END PAGE BODY -->
            <!--  BEGIN FOOTER  -->
            @include('layouts.parts.footer')
            <!--  END FOOTER  -->
        </div>
    </div>
    @include('layouts.parts.scripts')
</body>

</html>