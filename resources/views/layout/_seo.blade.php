@if(isset($seo))
    {{ $seo }}
@else
    <!-- Primary Meta Tags -->
    <title>{{ $title }}</title>
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="A simple blog made with Laravel 9 and Tailwind CSS">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="A simple blog made with Laravel 9 and Tailwind CSS">
    <meta property="og:image" content="{{ asset('img/site_cover.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="A simple blog made with Laravel 9 and Tailwind CSS">
    <meta property="twitter:image" content="{{ asset('img/site_cover.jpg') }}">

    <!-- Structured Data -->
    <script type='application/ld+json'>
    {
        "@context":"http:\/\/schema.org",
        "@type":"WebSite",
        "@id":"#website",
        "url":"{{ config('app.url') }}",
        "name":"{{ config('app.name') }}"
    }
    </script>
@endif
