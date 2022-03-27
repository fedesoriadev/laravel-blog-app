<div class="flex bg-slate-200 mb-6 space-x-4 p-5 rounded-xl">
    <img
        src="{{ $comment->author->avatar }}"
        class="w-8 h-8 rounded-full object-contain"
        alt="{{ $comment->author->name }}"
    >

    <div>
        <h3 class="font-bold">{{ $comment->author->name }}</h3>
        <p class="mb-3">{{ $comment->created_at->diffForHumans() }}</p>
        {{ $comment->body }}
    </div>
</div>
