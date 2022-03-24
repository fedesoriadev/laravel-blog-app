<x-app-layout>
    <header class="my-6 p-8 border-2 border-indigo-500 rounded-lg text-lg font-semibold">
        {{ __('Latest posts of tag ') }}
        <span class="text-indigo-600">{{ $tag->name }}</span>
    </header>

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
