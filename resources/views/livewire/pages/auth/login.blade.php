<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
    <form wire:submit="login">
        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <input type="email" wire:model="form.email" id="email" name="email" class="form-control @error('form.email') is-invalid @enderror" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mb-2">
            <label class="form-label">
                {{ __('Password') }}
                @if (Route::has('password.request'))
                <span class="form-label-description">
                    <a href="{{ route('password.request') }}" wire:navigate >{{ __('Forgot your password?') }}</a>
                </span>
                @endif
            </label>
            <div class="input-group input-group-flat">
                <input type="password" wire:model="form.password" id="password" class="form-control @error('form.password') is-invalid @enderror" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
        </div>
        <!-- Remember Me -->
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" wire:model="form.remember" id="remember" name="remember"
                    class="form-check-input" />
                <span class="form-check-label">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('Log in') }}</button>
        </div>
    </form>

    <x-slot:link>
        <div class="text-center text-secondary mt-3">{{ __("Don't have an account?") }} <a href="{{ route('register') }}" tabindex="-1">{{ __("Signup") }}</a></div>
    </x-slot:link>
</div>
