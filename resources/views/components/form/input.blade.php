<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="text-sm text-slate-500 dark:text-slate-50">{{ $labelText }}</label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes }}
    >

    @if($error)
        @error($name)
            <span class="block text-red-700 text-sm mt-2">{{ $message }}</span>
        @enderror
    @endif
</div>
