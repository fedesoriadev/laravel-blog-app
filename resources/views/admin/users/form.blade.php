<x-admin-layout>
    @include('admin.users._header')

    <x-form :action="route($user->exists ? 'users.update' : 'users.store', $user->username)"
            :method="$user->exists ? 'PATCH' : 'POST'"
            enctype="multipart/form-data">

        <div class="md:flex md:gap-6">
            <div class="md:w-3/4 p-4 rounded-lg bg-white drop-shadow">
                <x-auth.errors />

                <x-form.input name="email" type="email" :value="$user->email" required/>

                <x-form.input name="username" :value="$user->username" required/>

                <x-form.input name="name" :value="$user->name" required/>

                @if(!$user->exists)
                    <x-form.input name="password" type="password" autocomplete="new-password" required/>

                    <x-form.input name="password_confirmation" type="password" required/>
                @endif

                <fieldset class="mb-4">
                    <legend class="block text-base text-slate-500 dark:text-slate-50">{{ __('Role') }}</legend>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input type="radio" name="role_id" value="" id="role-none">
                            <label for="role-none" class="ml-3 block text-sm font-medium text-gray-700">
                                {{ __('None') }}
                            </label>
                        </div>

                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input
                                    type="radio"
                                    name="role_id"
                                    value="{{ $role->id }}"
                                    id="role-{{ $role->name->value }}"
                                    {{ $user->role?->id === $role->id ? 'checked=checked' : '' }}>
                                <label
                                    for="role-{{ $role->name->value }}"
                                    class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ ucfirst($role->name->value) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>

                <x-form.input name="avatar" type="file"/>

                <x-form.input name="about_me" :value="$user->about_me"/>

                <x-form.input name="twitter" type="url" :value="$user->twitter"/>

                <x-form.input name="twitch" type="url" :value="$user->twitch"/>

                <x-form.input name="youtube" type="url" :value="$user->youtube"/>

                <x-form.input name="github" type="url" :value="$user->github"/>

                <x-form.button>{{ __('Create account') }}</x-form.button>
            </div>

            <div class="mt-6 md:mt-0 md:w-1/4">
                <div class="rounded-lg bg-white drop-shadow divide-y divide-gray-200">
                    <div class="p-4">

                    </div>
                </div>
            </div>
        </div>
    </x-form>
</x-admin-layout>
