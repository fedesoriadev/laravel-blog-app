@props(['tag' => 'td'])

<{{ $tag }} {{ $attributes->merge([
    'class' => $tag === 'td'
        ? 'p-3 text-sm text-gray-600 shrink-0 whitespace-nowrap align-top'
        : 'p-3 text-sm sm:text-base text-gray-800 font-semibold shrink-0 whitespace-nowrap'
]) }}>
    {{ $slot }}
</{{ $tag }}>
