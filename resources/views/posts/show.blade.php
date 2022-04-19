<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('home') }}" class="flex items-center text-sm sm:text-base text-gray-900 space-x-2 dark:text-neutral-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>{{ __('Back to posts') }}</span>
        </a>
    </div>

    <article>
        <h1 class="mb-6 sm:mb-12 text-3xl sm:text-5xl lg:text-6xl font-bold text-gray-800 dark:text-neutral-200">
            {{ $post->title }}
        </h1>

        @if ($post->cover_image)
            <div class="mb-6 sm:mb-12 lg:-mx-20">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
            </div>
        @endif

        <div class="mb-6 sm:mb-12 flex flex-wrap items-center space-x-2">
            <a href="{{ route('authors.show', $post->author->username) }}" class="inline-flex space-x-2 items-center">
                <x-profile-picture :user="$post->author" />
                <span class="text-indigo-600 hover:text-indigo-800 transition dark:text-indigo-300 dark:hover:text-indigo-600">
                    {{ $post->author->name }}
                </span>
            </a>
            <span class="text-sm text-gray-800 dark:text-indigo-300"> / {{ $post->date->format('F d, Y') }} in </span>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-600">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="prose sm:prose-lg md:prose-xl prose-neutral dark:prose-invert">
            {!! \Illuminate\Support\Str::markdown($post->body) !!}
        </div>
    </article>

    @include('posts.partials.comments')

    @include('posts.partials.seo')
</x-app-layout>
