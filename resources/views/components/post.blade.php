<article class="pb-10 mb-10 border-b-2 border-gray-200 dark:border-neutral-800">
    <div class="mb-2 text-sm text-gray-800 dark:text-indigo-300">{{ $post->date?->format('F d, Y') }}</div>

    <h2 class="mb-4 font-bold text-3xl md:text-5xl transition hover:text-indigo-600 dark:hover:text-indigo-300">
        <a href="{{ $postUrl }}">{{ $post->title }}</a>
    </h2>

    <div class="mb-4">
        <x-link href="{{ $authorUrl }}">
            &commat;{{ $authorName }}
        </x-link>
        <span>&nbsp;{{ __('in') }}&nbsp;</span>
        @foreach($post->tags as $tag)
            <x-link href="{{ route('tags.show', $tag->slug) }}">
                {{ $tag->name }}
            </x-link>
        @endforeach
    </div>

    <div class="mb-6 text-lg">{{ $post->excerpt }}</div>

    <x-button href="{{ $postUrl }}">
        {{ __('Read more') }}
        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </x-button>
</article>
