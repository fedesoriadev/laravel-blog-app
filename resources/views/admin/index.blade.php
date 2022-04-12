<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('Dashboard') }}</h1>
        </div>
    </x-slot>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- Stats: Posts -->
        <div class="rounded-lg bg-white drop-shadow flex flex-col justify-between">
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
                    <h2 class="text-black text-3xl font-bold">{{ $postsCount }}</h2>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 flex items-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <h3 class="ml-2 text-gray-600 font-medium">{{ __('Top posts') }}</h3>
                </div>
                @foreach($topPosts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="block whitespace-nowrap overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                        {{ \Illuminate\Support\Str::words($post->title, 7) }}
                    </a>
                @endforeach
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>

        <!-- Stats: Comments -->
        <div class="rounded-lg bg-white drop-shadow flex flex-col justify-between">
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
                    <h2 class="text-black text-3xl font-bold">{{ $commentsCount }}</h2>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 flex items-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="ml-2 text-gray-600 font-medium">{{ __('Latest comments') }}</h3>
                </div>
                @foreach($latestComments as $comment)
                    <a href="{{ route('posts.show', $comment->post->slug) }}#comments"
                       class="block whitespace-nowrap overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                        {{ \Illuminate\Support\Str::words($comment->body, 7) }}
                    </a>
                @endforeach
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('comments.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>

        <!-- Stats: Users -->
        <div class="rounded-lg bg-white drop-shadow flex flex-col justify-between">
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
                    <h2 class="text-black text-3xl font-bold">{{ $userCount }}</h2>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 flex items-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <h3 class="ml-2 text-gray-600 font-medium">{{ __('New users') }}</h3>
                </div>
                @foreach($newUsers as $user)
                    <a href="{{ route('users.edit', $user->username) }}"
                       class="block whitespace-nowrap overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                        <x-profile-picture :user="$user" class="inline mr-2 w-[22px] h-[22px]"/>
                        <span>{{ $user->name }} on {{ $user->created_at->format('F j, Y') }}</span>
                    </a>
                @endforeach
            </div>
            <div class="rounded-b-lg bg-gray-100 px-6 py-4">
                <a href="{{ route('users.index') }}" class="text-indigo-600 font-medium">{{ __('View all') }}</a>
            </div>
        </div>

    </div>
</x-admin-layout>
