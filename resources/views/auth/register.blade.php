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
</x-app-layout>
