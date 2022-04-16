<div class="mb-4">
    <label for="{{ $name }}" class="flex items-center cursor-pointer">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" {{ $attributes }}>
        <span class="ml-2 text-base text-gray-500">{{ $label }}</span>
    </label>

    <x-form._error :name="$name" />
</div>
