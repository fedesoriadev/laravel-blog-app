<div class="text-right">
    <button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-4 py-2 rounded-md bg-indigo-600 text-white transition hover:bg-indigo-800'
    ]) }}>
        {{ $slot }}
    </button>
</div>
