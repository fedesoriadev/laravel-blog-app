<x-app-layout>
    @if(request()->has('search'))
        <header class="my-6 p-8 bg-slate-200 rounded-lg">
            {{ __('We found :count posts containing ', ['count' => $posts->count()]) }}
            <span class="text-indigo-600 font-bold italic">{{ request()->get('search') }}</span>
        </header>
    @endif

    @foreach($posts as $post)
        <x-post :post="$post"></x-post>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
