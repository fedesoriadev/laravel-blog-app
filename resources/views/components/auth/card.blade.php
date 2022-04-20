<div {{ $attributes->merge([
    'class' => "max-w-md mx-auto my-12 p-4 sm:p-8 bg-white border border-gray-200 rounded-lg drop-shadow dark:bg-neutral-900 dark:text-neutral-200 dark:border-neutral-700"
]) }}>
    {{ $slot }}
</div>
