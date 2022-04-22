<x-admin-layout>
    @include('admin.users._header')

    <x-form :action="route($user->exists ? 'users.update' : 'users.store', $user->username)"
            :method="$user->exists ? 'PATCH' : 'POST'"
            enctype="multipart/form-data">
            <div class="max-w-xl mx-auto px-6 rounded-lg bg-white drop-shadow divide-y divide-gray-200">
                <x-auth.errors />

                <fieldset class="py-6">
                    <x-form.input name="email" type="email" :value="$user->email" required/>

                    <x-form.input name="username" :value="$user->username" required/>

                    <x-form.input name="name" :value="$user->name" required/>

                    <div class="flex items-center space-x-2">
                        <x-profile-picture :user="$user" />
                        <x-form.input name="profile_picture" type="file" class="w-full"/>
                    </div>
                </fieldset>

                <fieldset class="py-6">
                    <x-form.input
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        :required="!$user->exists"
                    />

                    <x-form.input
                        name="password_confirmation"
                        type="password"
                        :required="!$user->exists"
                    />
                </fieldset>

                <fieldset class="py-6">
                    <label class="block text-base text-gray-500">{{ __('Role') }}</label>
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
                                    {{ old('role_id', $user->role?->id) === $role->id ? 'checked=checked' : '' }}>
                                <label
                                    for="role-{{ $role->name->value }}"
                                    class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ ucfirst(__($role->name->value)) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="py-6">
                    <x-form.textarea name="about_me" :value="$user->about_me" rows="3"/>

                    <x-form.input name="twitter" type="url" :value="$user->twitter"/>

                    <x-form.input name="twitch" type="url" :value="$user->twitch"/>

                    <x-form.input name="youtube" type="url" :value="$user->youtube"/>

                    <x-form.input name="github" type="url" :value="$user->github"/>
                </fieldset>

                <fieldset class="py-6">
                    <x-form.button>{{ __($user->exists ? 'Save' : 'Create account') }}</x-form.button>
                </fieldset>
            </div>
    </x-form>
</x-admin-layout>
