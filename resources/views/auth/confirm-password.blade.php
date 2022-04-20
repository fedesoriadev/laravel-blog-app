<x-app-layout>
    <x-auth.card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-auth.errors />

        <x-form :action="route('password.confirm')">
            <x-form.input name="password" type="password" autocomplete="current-password" required/>

            <div class="flex justify-end mt-4">
                <x-form.button>{{ __('Confirm') }}</x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-app-layout>
