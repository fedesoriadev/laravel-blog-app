<div class="mb-4">
    <x-form._label :name="$name">{{ $label }}</x-form._label>

    <textarea name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['rows' => 8]) }}>{{ $value }}</textarea>

    <x-form._error :name="$name" />
</div>
