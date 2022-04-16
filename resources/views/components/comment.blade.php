<div class="flex bg-gray-200 mb-6 space-x-4 p-5 rounded-xl">
    <x-profile-picture :user="$comment->author" />

    <div>
        <h3 class="font-bold">{{ $comment->author->name }}</h3>
        <p class="mb-3">{{ $comment->created_at->diffForHumans() }}</p>
        {{ $comment->body }}
    </div>
</div>
