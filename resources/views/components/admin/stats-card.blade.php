@props(['title', 'count', 'link'])

<div class="rounded-lg bg-white drop-shadow flex flex-col">
    <div class="rounded-t-lg px-6 py-4 pb-10 flex space-x-4">
        <div>
            <div class="w-14 h-14 bg-indigo-500 rounded-md text-white flex items-center justify-center">
                {{ $icon ?? null }}
            </div>
        </div>
        <div>
            <h3 class="text-gray-600">{{ __($title) }}</h3>
            <h2 class="text-black text-3xl font-bold">{{ $count }}</h2>
        </div>
    </div>
    <div class="divide-y divide-gray-200">
        {{ $slot }}
    </div>
    <div class="mt-auto rounded-b-lg bg-gray-100 px-6 py-4">
        <a href="{{ $link }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
    </div>
</div>
