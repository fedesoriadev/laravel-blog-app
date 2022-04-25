<x-admin-layout>
    @include('admin.posts._header')

    <x-form :action="route($post->exists ? 'posts.update' : 'posts.store', $post->slug)"
            :method="$post->exists ? 'PATCH' : 'POST'"
            enctype="multipart/form-data"
            x-data="{
                publish: {{ $post->status?->isPublished() ? 'true' : 'false' }},
                publishText: '{{ __('Save & publish') }}',
                draftText: '{{ __('Save draft') }}'
            }">

        <div class="md:flex md:gap-6">
            <div class="md:w-3/4 p-4 rounded-lg bg-white drop-shadow">
                <x-form.input name="title" :value="$post->title" required/>

                <div class="flex flex-col mb-6 sm:flex-row sm:mb-0 sm:items-center justify-between">
                    <x-form.input name="image" type="file" class="w-full"/>

                    @if($post->cover_image)
                        <img src="{{ $post->cover_image }}"
                             class="max-h-32 w-fit"
                             alt="{{ __('Cover image') }}">
                    @endif
                </div>

                <x-form.textarea name="excerpt" :value="$post->excerpt" rows="3"/>

                <x-form.textarea name="body" :value="$post->body" rows="20" required/>
            </div>

            <div class="mt-6 md:mt-0 md:w-1/4">
                <div class="rounded-lg bg-white drop-shadow divide-y divide-gray-200">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            @if($post->exists)
                                <a href="{{ route('posts.show', $post->slug) }}"
                                   class="px-4 py-2 rounded-md border border-indigo-500 text-indigo-500 transition hover:bg-indigo-800 hover:border-indigo-800 hover:text-white"
                                   target="_blank">Preview</a>
                            @endif
                            <x-form.button x-text="publish ? publishText : draftText">{{ __('Save') }}</x-form.button>
                        </div>
                    </div>

                    <div class="p-4">
                        <label for="publish" class="mb-4 flex items-center justify-between cursor-pointer">
                            <span class="text-base text-gray-500">{{ __('Publish') }}</span>
                            <input
                                type="checkbox"
                                name="publish"
                                id="publish"
                                class="ml-auto w-6 h-6"
                                @click="publish = !publish"
                                {{ $post->status?->isPublished() ? 'checked=checked' : '' }}>
                        </label>
                    </div>

                    <div class="p-4">
                        <x-form.input name="date" type="date" :value="$post->date?->toDateString()"/>

                        <x-form.input name="slug" :value="$post->slug"/>

                        @if(!Auth::user()->hasRole(\App\Enums\UserRole::AUTHOR))
                            <x-form.select
                                name="user_id"
                                :label="__('Author')"
                                :options="$authors"
                                :value="$post->user_id"
                                required/>
                        @else
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        @endif

                        <!-- Tags -->
                        <div class="mb-4">
                            <x-form._label name="tags">{{ __('Tags') }}</x-form._label>

                            <div x-data="{tags: [], newTag: '', inputName: 'tags'}"
                                 x-init='tags = @json($post->tags->pluck('name'))'>

                                <template x-for="tag in tags">
                                    <input type="hidden" x-bind:name="inputName + '[]'" x-bind:value="tag">
                                </template>

                                <input placeholder="{{ __('Add tag') }}"
                                       @keydown.enter.prevent="if (newTag.trim() !== '') tags.push(newTag.trim()); newTag = ''"
                                       x-model="newTag"
                                       id="tags"
                                       class="mb-4"
                                       type="text">

                                <template x-for="tag in tags" :key="tag">
                                    <span class="inline-flex items-center mr-1 space-x-1 px-2 py-1 bg-indigo-600 text-xs text-white rounded-full">
                                        <span x-text="tag"></span>
                                        <button type="button" @click="tags = tags.filter(i => i !== tag)">&times;</button>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </x-form>
</x-admin-layout>
