<x-admin-layout>
    <x-slot name="title">{{ __('Posts') }}</x-slot>

    <x-form :action="route($post->exists ? 'posts.update' : 'posts.store', $post->slug)"
            :method="$post->exists ? 'PATCH' : 'POST'"
            enctype="multipart/form-data">
        <x-form.input name="title" :value="$post->title" required />

        <x-form.select name="user_id" :label="__('Author')" :options="$authors" :value="$post->user_id" required />

        <x-form.input name="slug" :value="$post->slug" />

        <x-form.input name="date" type="date" :value="$post->date" />

        <x-form.input name="image" type="file" />

        <x-form.textarea name="excerpt" :value="$post->excerpt" rows="3" />

        <x-form.textarea name="body" :value="$post->body" rows="20" required />

        <x-form.button>{{ __('Save post') }}</x-form.button>
    </x-form>
</x-admin-layout>
