<{{ $tag }} {{ $attributes->merge([
    'class' => $tag === 'td'
        ? 'px-6 py-4 text-sm text-slate-600'
        : 'px-6 py-4 text-base text-slate-800 font-semibold'
]) }}>
    {{ $slot }}
</{{ $tag }}>
