<div id="comments" class="my-12">
    <h3 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">{{ __('Comments') }}</h3>

    <div class="my-6">
        @auth
            <div class="flex space-x-4">
                <x-profile-picture :user="Auth::user()" />

                <x-form :action="route('comments.store', $post->slug)" method="POST" class="w-full">
                    <x-form.textarea name="comment" label="" rows="6" />

                    <x-form.button>{{ __('Comment') }}</x-form.button>
                </x-form>
            </div>

        @else
            <p class="text-md">Please <a href="{{ route('login') }}" class="text-indigo-600">Log In</a> to comment!</p>
        @endauth
    </div>

    @foreach($post->comments as $comment)
        <x-comment :comment="$comment"/>
    @endforeach
</div>
