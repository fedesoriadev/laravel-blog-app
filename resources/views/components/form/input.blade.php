<div class="mb-4">
    <x-form._label :name="$name">{{ $label }}</x-form._label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" {{ $attributes }} />

    <x-form._error :name="$name" />
</div>
