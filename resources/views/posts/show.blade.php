<x-app-layout>
    <div class="my-4">
        <a href="{{ route('home') }}" class="flex items-center">
            <svg class="mr-2 w-4 h-4" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.47159 11.0739L0.306818 5.90909L5.47159 0.744318L6.49432 1.76705L3.07955 5.17045H12V6.64773H3.07955L6.49432 10.0568L5.47159 11.0739Z" fill="#0A214C"></path>
            </svg>
            <span>{{ __('Back to posts') }}</span>
        </a>
    </div>
    <article class="space-y-6">
        <h1 class="mb-12 text-xl sm:text-3xl md:text-5xl lg:text-7xl font-bold text-slate-800 dark:text-slate-300">
            {{ $post->title }}
        </h1>

        <div class="flex items-center space-x-6">
            <a href="{{ route('authors.show', $post->author->username) }}" class="inline-flex space-x-2 items-center">
                <img src="{{ $post->author->avatar }}"
                     class="w-8 h-8 rounded-full object-contain"
                     alt="{{ $post->author->name }}">
                <span class="text-slate-800 dark:text-slate-100">{{ $post->author->name }}</span>
            </a>
            <span>{{ $post->published_at->format('F j, Y') }}</span>
        </div>

        <div class="prose prose-xl prose-indigo">
            {!! \Illuminate\Support\Str::markdown($post->body) !!}
        </div>
    </article>
</x-app-layout>
