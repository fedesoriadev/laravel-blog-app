<article class="py-8 mb-8 border-b-2 border-slate-200">
    <h2 class="mb-2 font-bold text-3xl transition-colors duration-300 ease-linear hover:text-indigo-600">
        <a href="{{ $postUrl }}">{{ $post->title }}</a>
    </h2>

    <div>
        <a href="{{ $authorUrl }}" class="text-indigo-600 transition-all duration-300 ease-linear hover:text-indigo-900">
            {{ $authorName }}
        </a> | <span class="text-gray-500">{{ $post->published_at->format('F j, Y') }}</span>
    </div>

    <p class="my-6">{{ $post->excerpt }}</p>

    <div>
        <a href="{{ $postUrl }}"
           class="inline-block px-6 py-2 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-900 transition-colors duration-300 ease-linear">
            {{ __('Continue reading') }}
        </a>
    </div>
</article>
