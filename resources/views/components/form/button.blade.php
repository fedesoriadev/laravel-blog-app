<div class="text-right">
    <button {{ $attributes->merge(['class' => 'px-4 py-2 rounded-md bg-indigo-600 text-white transition dark:bg-indigo-400 hover:bg-indigo-800']) }}>
        {{ $slot }}
    </button>
</div>
