<x-app-layout>
    @if(request()->has('search'))
        <header class="my-6 p-8 border-2 border-indigo-500 rounded-lg text-lg font-semibold dark:border-indigo-300">
            {{ __('We found :count posts containing ', ['count' => $posts->count()]) }}
            <span class="text-indigo-600 dark:text-indigo-300">{{ request()->get('search') }}</span>
        </header>
    @endif

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
