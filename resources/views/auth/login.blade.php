<x-guest-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" />
                <x-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Password')" />
                <x-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="form-check-input"
                    name="remember"
                >
                <label for="remember_me" class="form-check-label">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <a href="{{ route('register') }}">Нет аккаунта? Регистрация</a>
                </div>

                <div class="d-flex align-items-center gap-2">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Забыли пароль?') }}
                        </a>
                    @endif

                    <x-button>
                        {{ __('Войти') }}
                    </x-button>
                </div>
            </div>

        </form>

    </x-auth-card>
</x-guest-layout>
