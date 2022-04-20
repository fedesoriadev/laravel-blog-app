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
        <meta property="article:tag" content="{{ $tag->name }}" />
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
