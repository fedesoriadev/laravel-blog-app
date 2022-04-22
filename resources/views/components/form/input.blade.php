<div class="mb-4">
    <x-form._label :name="$name">{{ __($label) }}</x-form._label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['required' => $required]) }}
    />

    <x-form._error :name="$name" />
</div>
