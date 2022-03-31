<div class="mb-4">
    <label for="{{ $name }}" class="text-sm text-slate-500 dark:text-slate-50">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
        <option value="">{{ __('Choose an option') }}</option>
        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ $isSelected($option->id) ? 'selected=selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <span class="block text-red-700 text-sm mt-2">{{ $message }}</span>
    @enderror
</div>
