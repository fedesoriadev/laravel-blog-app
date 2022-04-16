<a {{ $attributes->merge(['class' => 'text-indigo-600 hover:text-indigo-800 transition']) }}>
    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
    </svg>
    {{ $slot }}
</a>
