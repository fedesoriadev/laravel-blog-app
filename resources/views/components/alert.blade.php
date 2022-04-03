<div x-data="{ showAlert: true }"
     x-show="showAlert"
     role="alert"
     {{ $attributes->merge([
            'class' => 'flex items-center p-4 rounded-lg text-base font-medium ' . $alertType->containerClasses(),
            'id' => 'alert'
        ])
     }}>
    <div>
        {{ $slot }}
    </div>
    <button type="button"
            class="h-8 w-8 p-1.5 ml-auto rounded-lg focus:ring-2 {{ $alertType->closeButtonClasses() }}"
            data-dismiss-target="#{{ $attributes->get('id', 'alert') }}"
            aria-label="{{ __('Close') }}"
            @click="showAlert = false">
        <span class="sr-only">{{ __('Close') }}</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
