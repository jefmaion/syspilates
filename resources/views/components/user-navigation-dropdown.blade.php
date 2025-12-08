<div>
    <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
        <span class="avatar avatar-sm">
            {{ auth()->user()->initials }}
        </span>
        <div class="d-none d-xl-block ps-2">
            <div>{{ auth()->user()->shortName }}</div>
            <div class="mt-1 small text-secondary">{{ auth()->user()->email }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a href="?theme=dark" class="dropdown-item hide-theme-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-1">
                <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
            </svg>
            Modo Dark
        </a>
        <a href="?theme=light" class="dropdown-item hide-theme-light" data-bs-toggle="tooltip" data-bs-placement="bottom" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-1">
                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
            </svg>
            Modo Light
        </a>
        @if(!$slot->isEmpty())
            <div class="dropdown-divider"></div>
            {{ $slot }}
        @endif
        <div class="dropdown-divider"></div>
        <a href="#" wire:click="logout" class="dropdown-item">{{ __('Log Out') }}</a>
    </div>

</div>
