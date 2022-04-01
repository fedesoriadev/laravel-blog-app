<div class="mb-4">
    <x-form._label :name="$name">{{ $label }}</x-form._label>

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
        <option value="">{{ __('Choose an option') }}</option>
        @foreach($options as $option)
            <option value="{{ $option->id }}" {{ $isSelected($option->id) ? 'selected=selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>

    <x-form._error :name="$name" />
</div>
