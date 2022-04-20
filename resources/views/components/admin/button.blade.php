<a {{ $attributes->merge([
    'class' => 'bg-white py-1 px-2 border border-gray-300 rounded-md shadow-sm text-xs text-center leading-4 text-gray-700 hover:bg-indigo-800 hover:text-white transition focus:outline-none focus:ring focus:ring-offset focus:ring-indigo-500'
]) }}>
    {{ $slot }}
</a>
