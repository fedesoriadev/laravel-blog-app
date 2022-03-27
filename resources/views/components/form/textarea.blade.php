<div class="mb-4">
    <label for="{{ $name }}" class="text-sm text-slate-500 dark:text-slate-50">{{ $label }}</label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['rows' => 8]) }}
    >{{ $value }}</textarea>

    @error($name)
        <span class="block text-red-700 text-sm mt-2">{{ $message }}</span>
    @enderror
</div>
