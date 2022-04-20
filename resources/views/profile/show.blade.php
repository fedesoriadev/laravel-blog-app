<x-app-layout>
    <div class="max-w-xl mx-auto my-12">
        <x-profile-form-section>
            <x-slot name="title">{{ __('Profile information') }}</x-slot>

            @if (session('status') === 'profile-information-updated')
                <x-slot name="status">{{ __('Profile information has been updated.') }}</x-slot>
            @endif

            <x-form :action="route('user-profile-information.update')" method="PUT" enctype="multipart/form-data">
                <div class="px-4 sm:px-6">
                    <x-auth.errors :errors="$errors->updateProfileInformation"/>

                    <x-form.input name="email" type="email" :value="$user->email" required/>

                    <x-form.input name="username" :value="$user->username" required/>

                    <x-form.input name="name" :value="$user->name" required/>

                    <div class="flex items-center space-x-4">
                        <x-profile-picture :user="$user"/>

                        <x-form.input name="profile_picture" type="file" class="w-full"/>
                    </div>
                </div>
                <div class="mt-6 px-4 sm:px-6 py-4 bg-gray-100 dark:bg-neutral-800">
                    <x-form.button>{{ __('Save') }}</x-form.button>
                </div>
            </x-form>
        </x-profile-form-section>

        <x-profile-form-section>
            <x-slot name="title">{{ __('Update password') }}</x-slot>

            @if (session('status') === 'password-updated')
                <x-slot name="status">{{ __('Password has been updated.') }}</x-slot>
            @endif

            <x-form :action="route('user-password.update')" method="PUT">
                <div class="px-4 sm:px-6">
                    <x-auth.errors :errors="$errors->updatePassword"/>

                    <x-form.input name="current_password" type="password" autocomplete="current-password" required/>
                    <x-form.input name="password" label="{{ __('New password') }}" type="password"
                                  autocomplete="new-password" required/>
                    <x-form.input name="password_confirmation" type="password" required/>
                </div>
                <div class="mt-6 px-4 sm:px-6 py-4 bg-gray-100 dark:bg-neutral-800">
                    <x-form.button>{{ __('Save') }}</x-form.button>
                </div>
            </x-form>
        </x-profile-form-section>

        <x-profile-form-section>
            <x-slot name="title">{{ __('Delete account') }}</x-slot>

            <x-form :action="route('profile.destroy')" method="DELETE">
                <div class="px-4 sm:px-6">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </div>
                <div class="mt-6 px-4 sm:px-6 py-4 bg-gray-100 dark:bg-neutral-800">
                    <x-form.button>{{ __('Delete') }}</x-form.button>
                </div>
            </x-form>
        </x-profile-form-section>
    </div>
</x-app-layout>
