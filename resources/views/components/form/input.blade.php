<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm text-slate-500 dark:text-slate-50">{{ $label }}</label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" {{ $attributes }} />

    @error($name)
        <span class="block text-red-700 text-sm mt-2">{{ $message }}</span>
    @enderror
</div>
