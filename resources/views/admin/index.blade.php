<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('Dashboard') }}</h1>
        </div>
    </x-slot>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="rounded-lg bg-white drop-shadow">
            <div class="rounded-t-lg px-6 py-4 pb-10 flex space-x-4">
                <div>
                    <div class="w-14 h-14 bg-indigo-500 rounded-md text-white flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-gray-600">{{ __('Posts') }}</h3>
                    <h2 class="text-black text-3xl font-bold">{{ $posts_count }}</h2>
                </div>
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>

        <div class="rounded-lg bg-white drop-shadow">
            <div class="rounded-t-lg px-6 py-4 pb-10 flex space-x-4">
                <div>
                    <div class="w-14 h-14 bg-indigo-500 rounded-md text-white flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-gray-600">{{ __('Comments') }}</h3>
                    <h2 class="text-black text-3xl font-bold">{{ $comments_count }}</h2>
                </div>
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('comments.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>

        <div class="rounded-lg bg-white drop-shadow">
            <div class="rounded-t-lg px-6 py-4 pb-10 flex space-x-4">
                <div>
                    <div class="w-14 h-14 bg-indigo-500 rounded-md text-white flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-gray-600">{{ __('Users') }}</h3>
                    <h2 class="text-black text-3xl font-bold">{{ $user_count }}</h2>
                </div>
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('users.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>
    </div>
</x-admin-layout>
