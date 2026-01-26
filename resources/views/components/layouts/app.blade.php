<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.parts.header')

    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet">
</head>

<body>
    @include('layouts.parts.theme')
    <div class="page">
        <livewire:layout.sidebar />
        <livewire:layout.navigation />
        <div class="page-wrapper">
            {{ $slot }}
            @include('layouts.parts.footer')
        </div>
    </div>
    @include('layouts.parts.scripts')






     {{-- 2) CropperJS REAL (global) --}}
    <script src="https://unpkg.com/cropperjs@1.6.1/dist/cropper.min.js"></script>

    <script>
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
			alert(flash);
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
