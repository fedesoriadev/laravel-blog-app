<article class="py-8 mb-8 border-b-2 border-slate-200">
    <h2 class="mb-2 font-bold text-4xl transition-colors duration-300 ease-linear hover:text-indigo-600">
        <a href="{{ $postUrl }}">{{ $post->title }}</a>
    </h2>

    <div class="flex items-center space-x-4">
        <a href="{{ $authorUrl }}" class="text-indigo-600 transition-all duration-300 ease-linear hover:text-indigo-900">
            {{ $authorName }}
        </a>
        <span class="text-gray-700 dark:text-slate-100"> | {{ $post->published_at->format('F j, Y') }} | </span>
        <div>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="text-indigo-600 transition-all duration-300 ease-linear hover:text-indigo-900">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>

    <p class="my-6">{{ $post->excerpt }}</p>

    <a href="{{ $postUrl }}"
       class="inline-block px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-900 transition-colors duration-300 ease-linear">
        {{ __('Continue reading') }}
    </a>
</article>