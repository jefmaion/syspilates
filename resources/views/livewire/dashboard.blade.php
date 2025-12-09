<div>
   <x-slot name="header">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">{{ __('Welcome') }}</div>
                <h2 class="page-title">{{ __('Dashboard') }}</h2>
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            {{ __("You're logged in!") }}
        </div>
    </div>
</div>
