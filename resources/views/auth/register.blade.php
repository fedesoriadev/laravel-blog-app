<x-app-layout>
    <div class="max-w-sm mx-auto my-12 p-8 border border-slate-300 rounded-lg shadow-lg">
        <x-form action="{{ route('register') }}" method="POST">
            <x-form.input name="email" type="email" required/>
            <x-form.input name="username" required/>
            <x-form.input name="name" required/>
            <x-form.input name="password" type="password" autocomplete="new-password" required/>
            <x-form.input name="password_confirmation" type="password" required/>
            <x-form.button value="{{ __('Create account') }}" />
        </x-form>
    </div>
</x-app-layout>
