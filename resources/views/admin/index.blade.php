<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ __('Dashboard') }}</h1>
        </div>
    </x-slot>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- Stats: Posts -->
        <x-admin.stats-card title="Posts" :count="$postsCount" :link="route('posts.index')">
            <x-slot name="icon">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </x-slot>

            <div class="px-6 py-4 flex items-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <h3 class="ml-2 text-gray-600 font-medium">{{ __('Top posts') }}</h3>
            </div>
            @foreach($topPosts as $post)
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="block sm:whitespace-nowrap sm:overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                    {{ \Illuminate\Support\Str::words($post->title, 7) }}
                </a>
            @endforeach
        </x-admin.stats-card>

        <!-- Stats: Comments -->
        <x-admin.stats-card title="Comments" :count="$commentsCount" :link="route('comments.index')">
            <x-slot name="icon">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            </x-slot>

            <div class="px-6 py-4 flex items-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="ml-2 text-gray-600 font-medium">{{ __('Latest comments') }}</h3>
            </div>
            @foreach($latestComments as $comment)
                <a href="{{ route('posts.show', $comment->post->slug) }}#comments"
                   class="block sm:whitespace-nowrap sm:overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                    {{ \Illuminate\Support\Str::words($comment->body, 7) }}
                </a>
            @endforeach
        </x-admin.stats-card>

        <!-- Stats: Users -->
        <x-admin.stats-card title="Users" :count="$usersCount" :link="route('users.index')">
            <x-slot name="icon">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </x-slot>

            <div class="px-6 py-4 flex items-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <h3 class="ml-2 text-gray-600 font-medium">{{ __('New users') }}</h3>
            </div>
            @foreach($newUsers as $user)
                <a href="{{ route('users.edit', $user->username) }}"
                   class="block sm:whitespace-nowrap sm:overflow-hidden px-6 py-4 text-sm text-gray-600 transition hover:text-indigo-600">
                    <x-profile-picture :user="$user" class="inline mr-2" size="xs"/>
                    <span>{{ $user->name }} on {{ $user->created_at->format('F j, Y') }}</span>
                </a>
            @endforeach
        </x-admin.stats-card>

    </div>
</x-admin-layout>
