<x-app-layout>
    <x-auth.card>
        <x-auth.errors />

        <x-form :action="route('password.update')">
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-form.input name="email" type="email" :value="old('email', $request->email)" autofocus required />

            <x-form.input name="password" type="password" autocomplete="new-password" required/>

            <x-form.input name="password_confirmation" type="password" required/>

            <div class="flex items-center justify-end mt-4">
                <x-form.button>{{ __('Reset Password') }}</x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-app-layout>
