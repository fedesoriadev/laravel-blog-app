<div id="comments" class="my-8">
    <h3 class="text-2xl font-semibold text-slate-800">{{ __('Comments') }}</h3>

    <div class="my-6">
        @auth
            <x-form :action="route('comments.store', $post->slug)" method="POST">
                <x-form.textarea name="comment" label="{{ __('Add your comment below:') }}"/>

                <x-form.button>{{ __('Comment') }}</x-form.button>
            </x-form>
        @else
            <p class="text-md">Please <a href="{{ route('login') }}" class="text-indigo-600">Log In</a> to comment!</p>
        @endauth
    </div>

    @foreach($post->comments as $comment)
        <x-comment :comment="$comment"/>
    @endforeach
</div>
