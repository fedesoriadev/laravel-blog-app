<article class="py-8 mb-8 border-b-2 border-gray-200">
    <h2 class="mb-2 font-bold text-4xl transition hover:text-indigo-600">
        <a href="{{ $postUrl }}">{{ $post->title }}</a>
    </h2>

    <div class="flex items-center space-x-4">
        @if ($showAuthorLink)
            <a href="{{ $authorUrl }}" class="text-indigo-600 transition hover:text-indigo-800">
                {{ $authorName }}
            </a>
            <span> | </span>
        @endif

        <span class="text-gray-700 dark:text-gray-100">{{ $post->date->toDateString() }} | </span>

        <div>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="text-indigo-600 transition hover:text-indigo-800">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>

    <p class="my-6">{{ $post->excerpt }}</p>

    <a href="{{ $postUrl }}"
       class="inline-block px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-900 transition">
        {{ __('Continue reading') }}
    </a>
</article>
