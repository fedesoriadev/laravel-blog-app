<x-app-layout :title="__('Latest posts by :author', ['author' => $author->name])">
    <header class="mb-12 p-4 sm:p-8 border-2 border-indigo-600 rounded-lg dark:border-indigo-300 dark:text-neutral-200">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center mb-4 sm:mb-0 space-x-4">
                <x-profile-picture :user="$author" size="md" />

                <span class="sm:text-xl font-semibold">{{ $author->name }}</span>
            </div>
            <div class="flex items-center space-x-4">
                @if($author->twitter)
                    <a href="{{ $author->twitter }}" target="_blank">
                        <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-800 transition dark:text-indigo-300 dark:hover:text-indigo-600" fill="currentColor" stroke="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 273.5 222.3">
                            <path d="M273.5 26.3a109.77 109.77 0 0 1-32.2 8.8 56.07 56.07 0 0 0 24.7-31 113.39 113.39 0 0 1-35.7 13.6 56.1 56.1 0 0 0-97 38.4 54 54 0 0 0 1.5 12.8A159.68 159.68 0 0 1 19.1 10.3a56.12 56.12 0 0 0 17.4 74.9 56.06 56.06 0 0 1-25.4-7v.7a56.11 56.11 0 0 0 45 55 55.65 55.65 0 0 1-14.8 2 62.39 62.39 0 0 1-10.6-1 56.24 56.24 0 0 0 52.4 39 112.87 112.87 0 0 1-69.7 24 119 119 0 0 1-13.4-.8 158.83 158.83 0 0 0 86 25.2c103.2 0 159.6-85.5 159.6-159.6 0-2.4-.1-4.9-.2-7.3a114.25 114.25 0 0 0 28.1-29.1"/>
                        </svg>
                    </a>
                @endif
                @if($author->twitch)
                    <a href="{{ $author->twitch }}" target="_blank">
                        <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-800 transition dark:text-indigo-300 dark:hover:text-indigo-600" fill="currentColor" stroke="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <path d="M3.857 0 1 2.857v10.286h3.429V16l2.857-2.857H9.57L14.714 8V0H3.857zm9.714 7.429-2.285 2.285H9l-2 2v-2H4.429V1.143h9.142v6.286z"/>
                            <path d="M11.857 3.143h-1.143V6.57h1.143V3.143zm-3.143 0H7.571V6.57h1.143V3.143z"/>
                        </svg>
                    </a>
                @endif
                @if($author->youtube)
                    <a href="{{ $author->youtube }}" target="_blank">
                        <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-800 transition dark:text-indigo-300 dark:hover:text-indigo-600" fill="currentColor" stroke="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.17 13.6">
                            <path d="M18.77 2.13A2.4 2.4 0 0 0 17.09.42C15.59 0 9.58 0 9.58 0a57.55 57.55 0 0 0-7.5.4A2.49 2.49 0 0 0 .39 2.13 26.27 26.27 0 0 0 0 6.8a26.15 26.15 0 0 0 .39 4.67 2.43 2.43 0 0 0 1.69 1.71c1.52.42 7.5.42 7.5.42a57.69 57.69 0 0 0 7.51-.4 2.4 2.4 0 0 0 1.68-1.71 25.63 25.63 0 0 0 .4-4.67 24 24 0 0 0-.4-4.69zM7.67 9.71V3.89l5 2.91z" />
                        </svg>
                    </a>
                @endif
                @if($author->github)
                    <a href="{{ $author->github }}" target="_blank">
                        <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-800 transition dark:text-indigo-300 dark:hover:text-indigo-600" fill="currentColor" stroke="none"  viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        @if($author->about_me)
            <div class="mt-6 text-md sm:text-lg">{{ $author->about_me }}</div>
        @endif
    </header>

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
