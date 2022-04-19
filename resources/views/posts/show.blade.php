<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('home') }}" class="flex items-center text-gray-900 space-x-2 dark:text-neutral-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>{{ __('Back to posts') }}</span>
        </a>
    </div>

    <article>
        <h1 class="mb-12 text-2xl sm:text-4xl lg:text-6xl font-bold text-gray-800 dark:text-neutral-200">
            {{ $post->title }}
        </h1>

        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 mb-12">
            <a href="{{ route('authors.show', $post->author->username) }}" class="inline-flex space-x-2 items-center">
                <x-profile-picture :user="$post->author" />
                <span class="text-gray-800 dark:text-neutral-200">{{ $post->author->name }}</span>
            </a>
            <span>{{ $post->date->format('F d, Y') }}</span>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="text-indigo-600 transition hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-600">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="prose prose-xl prose-neutral dark:prose-invert">
            {!! \Illuminate\Support\Str::markdown($post->body) !!}
        </div>
    </article>

    @include('posts.partials.comments')

    @include('posts.partials.seo')
</x-app-layout>
