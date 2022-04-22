<x-app-layout>
    <div class="mb-4">
        <x-link href="{{ route('home') }}" class="flex items-center text-sm sm:text-base space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="text-gray-900 dark:text-neutral-200">{{ __('Back to posts') }}</span>
        </x-link>
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
            <x-link href="{{ route('authors.show', $post->author->username) }}"
                    class="inline-flex space-x-2 items-center">
                <x-profile-picture :user="$post->author" />
                <span>{{ $post->author->name }}</span>
            </x-link>

            <span class="text-sm text-gray-800 dark:text-indigo-300"> / {{ $post->date->format('F d, Y') }} {{ __('in') }} </span>

            @foreach($post->tags as $tag)
                <x-link href="{{ route('tags.show', $tag->slug) }}">
                    {{ $tag->name }}
                </x-link>
            @endforeach
        </div>

        <div class="prose sm:prose-lg md:prose-xl prose-neutral dark:prose-invert">
            {!! \Illuminate\Support\Str::markdown($post->body) !!}
        </div>
    </article>

    @include('posts._comments')

    @include('posts._seo')
</x-app-layout>
