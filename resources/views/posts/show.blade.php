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
                <x-profile-picture :user="$post->author" />
                <span class="text-slate-800 dark:text-slate-100">{{ $post->author->name }}</span>
            </a>
            <span>{{ $post->date->toDateString() }}</span>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="text-indigo-600 transition hover:text-indigo-800">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="prose prose-xl prose-indigo">
            {!! \Illuminate\Support\Str::markdown($post->body) !!}
        </div>
    </article>

    @include('posts.partials.comments')

    <x-slot name="seo">
        <!-- Primary Meta Tags -->
        <title>{{ $post->title }} | {{ config('app.name') }}</title>
        <meta name="title" content="{{ $post->title }} | {{ config('app.name') }}">
        <meta name="description" content="{{ $post->excerpt }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:locale" content="en_US">
        <meta property="og:title" content="{{ $post->title }} | {{ config('app.name') }}">
        <meta property="og:description" content="{{ $post->excerpt }}">
        <meta property="og:image" content="{{ $post->seo_cover_image }}">

        @foreach($post->tags as $tag)
            <meta property="article:tag" content="{{ $tag->name }}"/>
        @endforeach

        <meta property="article:published_time" content="{{ $post->date?->toIso8601String() }}">
        <meta property="og:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
        <meta property="article:author" content="{{ route('authors.show', $post->author->username) }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ request()->url() }}">
        <meta property="twitter:title" content="{{ $post->title }} | {{ config('app.name') }}">
        <meta property="twitter:description" content="{{ $post->excerpt }}">
        <meta property="twitter:image" content="{{ $post->seo_cover_image }}">

        <!-- Structured Data -->
        <script type='application/ld+json'>
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $post->title }}",
            "image": "{{ $post->seo_cover_image }}",
            "datePublished": "{{ $post->date?->toIso8601String() }}",
            "dateModified": "{{ $post->updated_at->toIso8601String() }}",
            "author": [{
                "@type": "Person",
                "name": "{{ $post->author->name }}",
                "url": "{{ route('authors.show', $post->author->username) }}"
            }]
        }
        </script>
    </x-slot>
</x-app-layout>
