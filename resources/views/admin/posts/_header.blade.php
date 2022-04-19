<x-slot name="header">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            <a href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
        </h1>

        @if($showCreateButton ?? false)
            <div class="ml-6">
                <form action="{{ route('posts.index') }}"
                      method="GET"
                      id="filter-status"
                      x-data="{}">
                    <select name="status"
                            class="text-sm w-32"
                            x-on:change="document.querySelector('#filter-status').submit();">
                        <option value="">{{ __('Status') }}</option>
                        @foreach(\App\Enums\PostStatus::cases() as $status)
                            <option
                                value="{{ $status->value }}"
                                {{ request()->get('status') === $status->value ? 'selected=selected' : '' }}>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="ml-auto">
                <a href="{{ route('posts.create') }}"
                   class="block px-3 py-2 text-sm sm:px-4 sm:text-base rounded-md bg-indigo-600 font-medium text-white transition hover:bg-indigo-800">
                    {{ __('Create post') }}
                </a>
            </div>
        @endif
    </div>
</x-slot>
