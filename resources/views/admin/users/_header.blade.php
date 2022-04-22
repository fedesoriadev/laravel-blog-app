<x-slot name="header">
    <div class="flex items-center">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
        </h1>

        @if($showCreateButton ?? false)
            <div class="ml-6">
                <form action="{{ route('users.index') }}"
                      method="GET"
                      id="filter-roles"
                      x-data="{}">
                    <select name="role"
                            class="text-sm w-32"
                            x-on:change="document.querySelector('#filter-roles').submit();">
                        <option value="">{{ __('Role') }}</option>
                        @foreach($roles as $role)
                            <option
                                value="{{ $role->name->value }}"
                                {{ request()->get('role') === $role->name->value ? 'selected=selected' : '' }}>
                                {{ ucfirst(__($role->name->value)) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="ml-auto">
                <a href="{{ route('users.create') }}"
                   class="block px-3 py-2 text-sm sm:px-4 sm:text-base rounded-md bg-indigo-600 font-medium text-white transition hover:bg-indigo-800">
                    {{ __('Create user') }}
                </a>
            </div>
        @endif
    </div>
</x-slot>
