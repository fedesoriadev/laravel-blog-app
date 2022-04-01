<x-app-layout>
    <x-auth.card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <x-form :action="route('verification.send')" method="POST">
                <x-form.button>{{ __('Resend Verification Email') }}</x-form.button>
            </x-form>

            <x-form :action="route('logout')" method="POST">
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </x-form>
        </div>
    </x-auth.card>
</x-app-layout>
