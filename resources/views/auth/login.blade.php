<x-app-layout>
    <x-auth.card>
        @if (session('status'))
            <div class="font-medium text-sm text-green-600 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <x-auth.errors />

        <x-form :action="route('login')" method="POST">
            <x-form.input name="email" type="email" autofocus required/>

            <x-form.input name="password" type="password" autocomplete="new-password" required/>

            <x-form.checkbox name="remember" :label="__('Remember me')" />

            <a href="{{ route('password.request') }}" class="text-xs text-gr">{{ __('Forgot password?') }}</a>

            <x-form.button>{{ __('Login') }}</x-form.button>
        </x-form>
    </x-auth.card>
</x-app-layout>
