<x-app-layout :title="__('Latest posts of :tag', ['tag' => $tag->name])">
    <x-header-frame>
        {{ __('Latest posts of tag ') }}
        <span class="text-indigo-600 dark:text-indigo-300">{{ $tag->name }}</span>
    </x-header-frame>

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
