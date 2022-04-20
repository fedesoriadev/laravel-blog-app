<x-app-layout :title="__('Latest posts by :author', ['author' => $author->name])">
    <x-header-frame>
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center mb-4 sm:mb-0 space-x-4">
                <x-profile-picture :user="$author" size="md" />

                <span class="sm:text-xl font-semibold">{{ $author->name }}</span>
            </div>
            <div class="flex items-center space-x-4">
                @include('authors._social-media')
            </div>
        </div>

        @if($author->about_me)
            <div class="mt-6 text-md sm:text-lg">{{ $author->about_me }}</div>
        @endif
    </x-header-frame>

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
