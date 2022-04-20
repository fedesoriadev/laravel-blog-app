@props(['comment'])

<div class="bg-gray-200 mb-6 p-5 rounded-xl dark:bg-neutral-800 dark:text-neutral-200">
    <div class="flex space-x-4 mb-4">
        <x-profile-picture :user="$comment->author" />
        <div>
            <h3 class="font-bold">{{ $comment->author->name }}</h3>
            <span class="text-sm">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="text-sm sm:text-base">
        {{ $comment->body }}
    </div>
</div>
