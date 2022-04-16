<{{ $tag }} {{ $attributes->merge([
    'class' => $tag === 'td'
        ? 'p-3 text-sm text-gray-600'
        : 'p-3 text-base text-gray-800 font-semibold'
]) }}>
    {{ $slot }}
</{{ $tag }}>
