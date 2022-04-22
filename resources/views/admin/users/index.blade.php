<x-admin-layout>
    @include('admin.users._header', ['showCreateButton' => true])

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">#</x-table.cell>
                <x-table.cell tag="th">{{ __('Name') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Email') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Username') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Role') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($users as $user)
            <tr>
                <x-table.cell>{{ $user->id }}</x-table.cell>
                <x-table.cell>
                    <div class="flex items-center space-x-2">
                        <x-profile-picture :user="$user" />
                        <span class="font-medium">{{ $user->name }}</span>
                        @if($user->hasRole(\App\Enums\UserRole::AUTHOR))
                            <a href="{{ route('authors.show', $user->username) }}"
                               class="text-gray-400 transition hover:text-indigo-600"
                               target="_blank">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </x-table.cell>
                <x-table.cell>{{ $user->email }}</x-table.cell>
                <x-table.cell>{{ $user->username }}</x-table.cell>
                <x-table.cell>
                    <span class="text-xs text-gray-700 tracking-wide px-2 py-1 rounded-xl {{ $user->role?->name->background() }}">
                        {{ ucfirst(__($user->role?->name->value)) }}
                    </span>
                </x-table.cell>
                <x-table.cell>
                    {{ $user->created_at->format('Y-m-d H:i') }}

                    @if($user->hasVerifiedEmail())
                        <span title="{{ __('Email verified at :date', ['date' => $user->email_verified_at]) }}"
                              class="-mb-1 ml-2 text-green-500 inline-block">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </span>
                    @endif
                </x-table.cell>
                <x-table.cell class="flex items-center space-x-2">
                    <x-admin.button href="{{ route('users.edit', $user->username) }}">
                        {{ __('Edit') }}
                    </x-admin.button>

                    <x-form.confirmation :action="route('users.destroy', $user->username)" method="DELETE">
                        {{ __('Delete') }}
                    </x-form.confirmation>

                    @if (!$user->hasVerifiedEmail())
                        <x-form.confirmation
                                :action="route('users.resend-verification', $user->username)"
                                title="{{ __('Resend verification email') }}"
                               >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </x-form.confirmation>
                    @endif
                </x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $users->links() }}
    </div>
</x-admin-layout>
