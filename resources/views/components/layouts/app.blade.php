<!DOCTYPE html>
<html wire:poll lang="{{ str_replace('_', '-', app()->getLocale()) }}" @foreach(config('tabler.theme-config') as $key=>
$value) data-bs-{{$key}}="{{$value}}" @endforeach
data-bs-theme="{{ session('theme.mode') }}">

<head>
    @include('layouts.parts.header')
</head>

<body class="">
    @include('layouts.parts.theme')
    <div class="page">
        <livewire:layout.sidebar />
        <livewire:layout.navigation />
        <div class="page-wrapper">
            {{-- @dd(session()) --}}
            {{ $slot }}
            @include('layouts.parts.footer')
        </div>
    </div>

    @include('layouts.parts.scripts')
    <script>
        window.addEventListener('theme-updated', (params) => {
            document.documentElement.setAttribute('data-bs-theme', params.detail.theme)
        });

        window.addEventListener('show-modal', (params) => {
                return getModal(params.detail.modal).show()
            });
            window.addEventListener('hide-modal', (params) => {
                return getModal(params.detail.modal).hide()
            });

            function getModal(modal) {
                return tabler.bootstrap.Modal.getOrCreateInstance('#' + modal)
            }

            window.addEventListener('show-modal-delete', (params) => {
                return getModal('modal-delete').show()
            });

            window.addEventListener('hide-modal-delete', (params) => {
                return getModal('modal-delete').hide()
            });

            window.addEventListener('flash-message', (params) => {
                const flash = document.getElementById('alert-message');
                if (flash) {
                    flash.style.display = 'block';
                    setTimeout(() => {
                        flash.style.display = 'none';
                    }, 3000); // Oculta após 3 segundos
                }
            });

            

    </script>
    @stack('scripts')
</body>

</html>