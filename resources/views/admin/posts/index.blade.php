<x-admin-layout>
    @include('admin.posts._header')

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ _('Title') }}</x-table.cell>
                @if(!Auth::user()->hasRole(\App\Enums\UserRole::AUTHOR))
                    <x-table.cell tag="th">{{ _('Author') }}</x-table.cell>
                @endif
                <x-table.cell tag="th">{{ _('Tag') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Date') }}</x-table.cell>
                <x-table.cell tag="th">{{ _('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($posts as $post)
            <tr>
                <x-table.cell class="flex items-center">
                    <span class="w-2 h-2 block rounded-full mr-3 {{ $post->status->background() }}"
                          title="{{ $post->status->name }}"></span>
                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="hover:text-indigo-800 transition">{{ $post->title }}</a>
                </x-table.cell>
                @if(!Auth::user()->hasRole(\App\Enums\UserRole::AUTHOR))
                    <x-table.cell>{{ $post->author->name }}</x-table.cell>
                @endif
                <x-table.cell>
                    @if($post->tags)
                        @foreach($post->tags->pluck('name') as $tag)
                            <span class="text-xs text-gray-700 tracking-wide px-2 py-1 rounded-xl bg-indigo-100">{{ $tag }}</span>
                        @endforeach
                    @endif
                </x-table.cell>
                <x-table.cell>{{ $post->date }}</x-table.cell>
                <x-table.cell>{{ $post->created_at->format('F j, Y') }}</x-table.cell>
                <x-table.cell class="flex items-center w-[1%] whitespace-nowrap">
                    <x-link href="{{ route('posts.edit', $post->slug) }}" class="mr-2">
                        {{ __('Edit') }}
                    </x-link>

                    <x-form.confirmation
                        :action="route('posts.' . ($post->status->isPublished() ? 'archive' : 'publish') , $post->slug)"
                        method="POST">
                        {{ __($post->status->isPublished() ? 'Archive' : 'Publish') }}
                    </x-form.confirmation>
                </x-table.cell>
            </tr>
        @endforeach
    </x-table>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</x-admin-layout>
