<x-admin-layout>
    @include('admin.users._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Name') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Email') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Username') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Role') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($users as $user)
            <tr>
                <x-table.cell>{{ $user->name }}</x-table.cell>
                <x-table.cell>{{ $user->email }}</x-table.cell>
                <x-table.cell>{{ $user->username }}</x-table.cell>
                <x-table.cell>{{ $user->role?->name->value }}</x-table.cell>
                <x-table.cell>{{ $user->created_at->format('F j, Y') }}</x-table.cell>
                <x-table.cell>
                    <x-link href="{{ route('users.edit', $user->username) }}">
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
