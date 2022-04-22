<x-app-layout>
    <x-auth.card>
        @if (session('status'))
            <x-auth.success-message>
                {{ session('status') }}
            </x-auth.success-message>
        @endif

        <x-auth.errors />

        <x-form :action="route('login')">
            <x-form.input name="email" type="email" autofocus required />

            <x-form.input name="password" type="password" autocomplete="new-password" required />

            <div class="flex items-center justify-between mb-6">
                <label for="remember" class="flex items-center cursor-pointer">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="ml-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
                </label>

                <x-link href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </x-link>
            </div>

            <x-form.button>{{ __('Log in') }}</x-form.button>
        </x-form>
    </x-auth.card>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-700 dark:text-neutral-200">{{ __("Don't have an account?") }}</p>

        <x-link href="{{ route('register') }}">
            {{ __('Sign up') }}
        </x-link>
    </div>
</x-app-layout>
