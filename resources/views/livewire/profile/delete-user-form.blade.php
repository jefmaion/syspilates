<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {

        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);


        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }



}; ?>
{{--
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before
            deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete
        Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please
                enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> --}}
<div>

    <div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">{{ __('Delete Account') }}</h3>
            <p class="card-subtitle">{{ __('Once your account is deleted, all of its resources and data will be
                permanently deleted. Before deleting your account, please download any data or information that you wish
                to retain.') }}</p>
        </div>
    </div>
    <div class="card-body">

        <button type="button" class="btn btn-danger" wire:click="$dispatch('show-modal')">
            {{ __('Delete Account') }}
        </button>

        <div class="modal modal-blur fade " id="modal-delete-account" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modsal-sm modal-dialog-centered" role="document">
                <form wire:submit="deleteUser">
                    <div class="modal-content">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-danger"></div>
                        <div class="modal-body  py-4">
                            <div class="text-center">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon mb-2 text-danger icon-lg">
                                <path d="M12 9v4"></path>
                                <path
                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                </path>
                                <path d="M12 16h.01"></path>
                            </svg>
                            <h3>{{ __('Are you sure you want to delete your account?') }}</h3>
                            <div class="text-secondary">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')
                                }}
                            </div>
                            </div>

                            <div class="mt-6 text-left">
                                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                <x-text-input wire:model="password" id="password" name="password" type="password" placeholder="{{ __('Password') }}" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-3 w-100" data-bs-dismiss="modal">{{ __('Cancel')
                                            }}</a>
                                    </div>
                                    <div class="col">
                                        <button  class="btn btn-danger btn-4 w-100"> {{ __('Delete Account') }} </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        window.addEventListener('show-modal', () => {
			tabler.bootstrap.Modal.getOrCreateInstance('#modal-delete-account').show()
        });
    </script>
</div>
