<x-slot name="header">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">
            <a href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
        </h1>

        <a href="{{ route('posts.create') }}"
           class="ml-auto px-4 py-2 rounded-lg bg-indigo-600 text-white dark:bg-indigo-400">
            {{ __('Create post') }}
        </a>
    </div>
</x-slot>
