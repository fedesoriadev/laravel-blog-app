<div {{ $attributes->merge([
    'class' => "max-w-sm mx-auto my-12 p-8 bg-white border border-gray-200 dark:bg-slate-700 dark:border-gray-800 rounded-lg drop-shadow"
]) }}>
    {{ $slot }}
</div>
