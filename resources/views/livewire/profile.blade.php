<div>
        <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="mb-3">
        <livewire:profile.update-profile-information-form />
    </div>

    <div class="mb-3">
        <livewire:profile.update-password-form />
    </div>

    <div>
        <livewire:profile.delete-user-form />
    </div>

</div>
