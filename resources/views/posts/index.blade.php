<x-app-layout>
    @if(request()->has('search'))
        <x-header-frame>
            {{ __('We found :count posts containing ', ['count' => $posts->count()]) }}
            <span class="text-indigo-600 dark:text-indigo-300">{{ request()->get('search') }}</span>
        </x-header-frame>
    @endif

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
