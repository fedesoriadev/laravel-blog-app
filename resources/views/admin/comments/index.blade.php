<x-admin-layout>
    @include('admin.comments._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Comment') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Author') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Post') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
            </tr>
        </x-slot>

        @foreach($comments as $comment)
            <tr>
                <x-table.cell>
                    <a href="{{ route('posts.show', $comment->post->slug) }}#comments">{{ substr($comment->body, 0, 50) }}</a>
                </x-table.cell>
                <x-table.cell>{{ $comment->author->name }}</x-table.cell>
                <x-table.cell>
                    <a href="{{ route('posts.show', $comment->post->slug) }}">{{ $comment->post->title }}</a>
                </x-table.cell>
                <x-table.cell>{{ $comment->created_at->format('F j, Y') }}</x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $comments->links() }}
    </div>
</x-admin-layout>
