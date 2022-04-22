<x-admin-layout>
    @include('admin.comments._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ __('Author') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Comment') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($comments as $comment)
            <tr>
                <x-table.cell>{{ $comment->author->name }}</x-table.cell>
                <x-table.cell class="!whitespace-normal">{{ $comment->body }}</x-table.cell>
                <x-table.cell>{{ $comment->created_at->format('Y-m-d H:i') }}</x-table.cell>
                <x-table.cell class="flex items-center">
                    <x-admin.button href="{{ route('posts.show', $comment->post->slug) }}#comments" target="_blank" class="mr-2">
                        {{ __('View post') }}
                    </x-admin.button>

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
