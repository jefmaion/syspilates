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
        <livewire:layout.sidebar />
        <!--  END SIDEBAR  -->

        <!-- BEGIN NAVBAR  -->
        <livewire:layout.navigation />
        <!-- END NAVBAR  -->

        <div class="page-wrapper">
            {{ $slot }}
            <!--  BEGIN FOOTER  -->
            @include('layouts.parts.footer')
            <!--  END FOOTER  -->
        </div>
    </div>
    @include('layouts.parts.scripts')
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
</body>

</html>