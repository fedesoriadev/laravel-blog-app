<x-app-layout>
    <x-auth.card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="font-medium text-sm text-green-600">{{ session('status') }}</div>
        @endif

        <x-auth.errors />

        <x-form :action="route('password.email')" method="POST">
            <x-form.input name="email" type="email" autofocus required />

            <div class="flex items-center justify-end mt-4">
                <x-form.button>{{ __('Email Password Reset Link') }}</x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-app-layout>
