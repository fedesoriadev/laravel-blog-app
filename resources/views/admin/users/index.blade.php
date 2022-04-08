<x-admin-layout>
    @include('admin.users._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">#</x-table.cell>
                <x-table.cell tag="th">{{ _('Name') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Email') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Username') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Role') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
                <x-table.cell tag="th" class="w-[1%] whitespace-nowrap"></x-table.cell>
            </tr>
        </x-slot>

        @foreach($users as $user)
            <tr>
                <x-table.cell>{{ $user->id }}</x-table.cell>
                <x-table.cell>
                    <x-user-avatar :user="$user" class="inline mr-2" />
                    <span class="font-medium">{{ $user->name }}</span>
                </x-table.cell>
                <x-table.cell>{{ $user->email }}</x-table.cell>
                <x-table.cell>{{ $user->username }}</x-table.cell>
                <x-table.cell>
                    <span class="text-xs text-gray-700 tracking-wide px-2 py-1 rounded-xl {{ $user->role?->name->background() }}">
                        {{ ucfirst($user->role?->name->value) }}
                    </span>
                </x-table.cell>
                <x-table.cell>
                    {{ $user->created_at->format('F j, Y') }}

                    @if($user->email_verified_at)
                        <span title="{{ __('Email verified at :date', ['date' => $user->email_verified_at]) }}"
                              class="-mb-1 ml-2 text-green-500 inline-block">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </span>
                    @endif
                </x-table.cell>
                <x-table.cell class="flex items-center w-[1%] whitespace-nowrap">
                    <x-link href="{{ route('users.edit', $user->username) }}" class="mr-2">
                        {{ __('Edit') }}
                    </x-link>

                    <x-form.confirmation :action="route('users.destroy', $user->username)" method="DELETE">
                        {{ __('Delete') }}
                    </x-form.confirmation>
                </x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $users->links() }}
    </div>
</x-admin-layout>
