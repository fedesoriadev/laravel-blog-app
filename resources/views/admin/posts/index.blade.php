<x-admin-layout>
    <x-slot name="title">{{ __('Posts') }}</x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Title') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Author') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Tag') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Date') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($posts as $post)
            <tr>
                <x-table.cell class="flex items-center">
                    <span class="w-2 h-2 block rounded-full mr-3 {{ $post->status->color() }}"
                          title="{{ $post->status->name }}"></span>
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </x-table.cell>
                <x-table.cell>{{ $post->author->name }}</x-table.cell>
                <x-table.cell>{{ $post->tags->first()?->name }}</x-table.cell>
                <x-table.cell>{{ $post->date }}</x-table.cell>
                <x-table.cell>{{ $post->created_at->format('F j, Y') }}</x-table.cell>
                <x-table.cell>
                    <a href="{{ route('posts.edit', $post->slug) }}"
                       class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                </x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</x-admin-layout>
