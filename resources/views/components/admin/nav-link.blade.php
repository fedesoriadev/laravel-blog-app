<a {{ $attributes->merge([
    'class' => $isActive()
        ? 'bg-indigo-800 text-white px-3 py-2 rounded-md text-sm font-medium'
        : 'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium',
    'aria-current' => $isActive() ? 'page' : null
]) }}>
    {{ $slot }}
</a>
