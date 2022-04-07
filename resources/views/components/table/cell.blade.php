<{{ $tag }} {{ $attributes->merge([
    'class' => $tag === 'td'
        ? 'px-4 py-3 text-sm text-slate-600'
        : 'px-4 py-3 text-base text-slate-800 font-semibold'
]) }}>
    {{ $slot }}
</{{ $tag }}>
