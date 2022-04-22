<x-admin-layout>
    @include('admin.posts._header', ['showCreateButton' => true])

    <x-table>
        <x-slot name="thead">
            <tr>
                <x-table.cell tag="th">{{ __('Title') }}</x-table.cell>
                @if(!Auth::user()->hasRole(\App\Enums\UserRole::AUTHOR))
                    <x-table.cell tag="th">{{ __('Author') }}</x-table.cell>
                @endif
                <x-table.cell tag="th">{{ __('Tag') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Date') }}</x-table.cell>
                <x-table.cell tag="th">{{ __('Created at') }}</x-table.cell>
                <x-table.cell tag="th">&nbsp;</x-table.cell>
            </tr>
        </x-slot>

        @foreach($posts as $post)
            <tr>
                <x-table.cell>
                    <div class="flex items-center space-x-2">
                        <span class="shrink-0 w-2 h-2 block rounded-full mr-3 {{ $post->status->background() }}"
                              title="{{ __($post->status->name) }}"></span>
                        <span>{{ $post->title }}</span>
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="text-gray-400 transition hover:text-indigo-600"
                           target="_blank">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </x-table.cell>

                @if(!Auth::user()->hasRole(\App\Enums\UserRole::AUTHOR))
                    <x-table.cell>
                        <div class="flex items-center space-x-2">
                            <span>{{ $post->author->name }}</span>
                            <a href="{{ route('authors.show', $post->author->username) }}"
                               class="text-gray-400 transition hover:text-indigo-600"
                               target="_blank">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </x-table.cell>
                @endif

                <x-table.cell>
                    @if($post->tags)
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                               class="text-xs text-gray-700 tracking-wide px-2 py-1 rounded-xl bg-indigo-100 transition hover:text-white hover:bg-indigo-600"
                               target="_blank">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    @endif
                </x-table.cell>

                <x-table.cell>{{ $post->date?->toDateString() }}</x-table.cell>
                <x-table.cell>{{ $post->created_at->format('Y-m-d H:i') }}</x-table.cell>
                <x-table.cell class="flex items-center">
                    <x-admin.button href="{{ route('posts.edit', $post->slug) }}" class="mr-2">
                        {{ __('Edit') }}
                    </x-admin.button>

                    <x-form.confirmation
                        :action="route('posts.' . ($post->status->isPublished() ? 'archive' : 'publish') , $post->slug)"
                       >
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
