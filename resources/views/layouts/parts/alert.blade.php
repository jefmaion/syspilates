@foreach (['success', 'warning', 'danger', 'info'] as $type)
    @if (session($type))
    <div class="container-fluid mt-3" 
            wire:key="alert-{{ $type }}-{{ uniqid() }}"
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 10000)"
            x-show="show"
            x-transition.opacity.duration.500ms>
        <div class="alert alert-dismissible alert-{{ $type }}">
            {{ session($type) }}
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    </div>
    @endif
@endforeach
{{-- 
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-icon">
        <!-- Download SVG icon from http://tabler.io/icons/icon/alert-circle -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon alert-icon icon-2">
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
            <path d="M12 8v4"></path>
            <path d="M12 16h.01"></path>
        </svg>
    </div>
    An error occurred!
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div> --}}