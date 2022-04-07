<x-admin-layout>
    @include('admin.comments._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Author') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Comment') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Create at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($comments as $comment)
            <tr>
                <x-table.cell>{{ $comment->author->name }}</x-table.cell>
                <x-table.cell class="max-w-3xl">{{ $comment->body }}</x-table.cell>
                <x-table.cell>{{ $comment->created_at->format('F j, Y') }}</x-table.cell>
                <x-table.cell class="flex items-center w-[1%] whitespace-nowrap">
                    <x-link href="{{ route('posts.show', $comment->post->slug) }}#comments" target="_blank" class="mr-2">
                        {{ __('View post') }}
                    </x-link>

                    <x-form.confirmation :action="route('comments.destroy', $comment)" method="DELETE">
                        {{ __('Delete') }}
                    </x-form.confirmation>
                </x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $comments->links() }}
    </div>
</x-admin-layout>
