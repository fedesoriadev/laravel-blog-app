<{{ $tag }} {{ $attributes->merge([
    'class' => $tag === 'td'
        ? 'p-3 text-sm text-slate-600'
        : 'p-3 text-base text-slate-800 font-semibold'
]) }}>
    {{ $slot }}
</{{ $tag }}>
