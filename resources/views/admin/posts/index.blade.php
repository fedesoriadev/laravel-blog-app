<x-admin-layout>
    <x-slot name="title">{{ __('Posts') }}</x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Title') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Author') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Tag') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Status') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Published at') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
            </tr>
        </x-slot>

        @foreach($posts as $post)
            <tr>
                <x-table.cell>
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </x-table.cell>
                <x-table.cell>{{ $post->author->name }}</x-table.cell>
                <x-table.cell>{{ $post->tags->first()?->name }}</x-table.cell>
                <x-table.cell>{{ $post->status->value }}</x-table.cell>
                <x-table.cell>{{ $post->published_at?->format('F j, Y') }}</x-table.cell>
                <x-table.cell>{{ $post->created_at->format('F j, Y') }}</x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</x-admin-layout>
