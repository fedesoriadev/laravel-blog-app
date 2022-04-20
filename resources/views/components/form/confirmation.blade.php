@props(['action', 'method' => 'POST'])

<x-form
    :action="$action"
    :method="$method"
    x-data="{ showConfirmationButton: false }"
    {{ $attributes->merge(['class' => 'inline-block']) }}>

    <button
        @click="showConfirmationButton = true"
        x-show="!showConfirmationButton"
        type="button"
        class="bg-white py-1 px-2 border border-gray-300 rounded-md shadow-sm text-xs leading-4 text-gray-700 hover:bg-indigo-800 hover:text-white transition focus:outline-none focus:ring focus:ring-offset focus:ring-indigo-500"
    >
        {{ $slot }}
    </button>

    <div x-show="showConfirmationButton" style="display: none" class="flex items-center">
        <button
            type="submit"
            class="text-green-400 transition hover:text-green-600 mr-0.5">
            <span class="sr-only">{{ __('Confirm') }}</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <button
            type="button"
            @click="showConfirmationButton = false"
            class="text-gray-400 transition hover:text-gray-600">
            <span class="sr-only">{{ __('Cancel') }}</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>
</x-form>
