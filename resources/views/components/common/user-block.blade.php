@props([
    'initials' => null,
    'avatar' => null,
    'color' => 'primary',
    'size' => 'lg',
    'subtitle' => null,
    'sideTitle' => null,
])
<div class="row mb-3">
    <div class="col-auto pe-0">
        <x-common.avatar initials="{{ $initials }}" size="{{ $size }}" avatar="{{ $avatar }}" />
    </div>
    <div class="col">
        <div class="d-flex align-items-center">
            <h2 class="font-weight-medium mb-0 me-1">
                <strong>
                    {{ $title }}
                </strong>
            </h2>
            @if ($sideTitle)
                <div class="d-flex">
                    {{ $sideTitle }}
                </div>
            @endif
        </div>
        @if ($subtitle)
            {{ $subtitle }}
        @endif
        {{ $slot }}
    </div>
</div>
