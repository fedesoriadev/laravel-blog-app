<x-app-layout>
    <div class="max-w-sm mx-auto my-12 p-8 border border-slate-300 rounded-lg shadow-lg">
        <x-form :action="route('login')" method="GET">
            <x-form.input name="email" type="email" required/>
            <x-form.input name="password" type="password" autocomplete="new-password" required/>
            <x-form.checkbox name="remember" :label="__('Remember me')" />
            <x-form.button :value="__('Login')" />
        </x-form>
    </div>
</x-app-layout>
