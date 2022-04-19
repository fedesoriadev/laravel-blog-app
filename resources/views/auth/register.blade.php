<x-app-layout>
    <x-auth.card>
        <x-auth.errors />

        <x-form :action="route('register')" method="POST">
            <x-form.input name="email" type="email" required/>

            <x-form.input name="username" required/>

            <x-form.input name="name" required/>

            <x-form.input name="password" type="password" autocomplete="new-password" required/>

            <x-form.input name="password_confirmation" type="password" required/>

            <x-form.button>{{ __('Create account') }}</x-form.button>
        </x-form>
    </x-auth.card>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-700 dark:text-neutral-200">{{ __('Already have an account?') }}</p>

        <a href="{{ route('login') }}"
           class="text-md text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-600">
            {{ __('Sign in') }}
        </a>
    </div>
</x-app-layout>
