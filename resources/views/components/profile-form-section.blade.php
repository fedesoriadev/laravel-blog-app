<div class="mb-10 bg-white border border-gray-200 rounded-lg drop-shadow dark:bg-gray-700 dark:border-gray-800">
    <div class="p-6">
        <h4 class="text-lg font-semibold text-gray-800">{{ $title }}</h4>

        @if($status ?? false)
            <x-alert :type="\App\Enums\AlertType::SUCCESS->value" class="mt-3">
                {{ $status }}
            </x-alert>
        @endif
    </div>

    {{ $slot }}
</div>
