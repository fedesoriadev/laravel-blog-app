<x-app-layout>
    <x-auth.card>
        @if (session('status'))
            <div class="font-medium text-sm text-green-600 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <x-auth.errors />

        <x-form :action="route('login')" method="POST">
            <x-form.input name="email" type="email" autofocus required />

            <x-form.input name="password" type="password" autocomplete="new-password" required />

            <div class="flex items-center justify-between mb-6">
                <label for="remember" class="flex items-center cursor-pointer">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="ml-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
                </label>

                <a href="{{ route('password.request') }}"
                   class="text-xs text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-600">
                    {{ __('Forgot password?') }}
                </a>
            </div>

            <x-form.button>{{ __('Login') }}</x-form.button>
        </x-form>
    </x-auth.card>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-700 dark:text-neutral-200">{{ __('Don\'t have an account?') }}</p>

        <a href="{{ route('register') }}"
           class="text-md text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-600">
            {{ __('Sign up') }}
        </a>
    </div>
</x-app-layout>
