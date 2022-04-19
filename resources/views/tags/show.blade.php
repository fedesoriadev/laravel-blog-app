<x-app-layout :title="__('Latest posts of :tag', ['tag' => $tag->name])">
    <header class="mb-12 p-8 border-2 border-indigo-600 rounded-lg dark:border-indigo-300 dark:text-neutral-200">
        {{ __('Latest posts of tag ') }}
        <span class="text-indigo-600 dark:text-indigo-300">{{ $tag->name }}</span>
    </header>

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
