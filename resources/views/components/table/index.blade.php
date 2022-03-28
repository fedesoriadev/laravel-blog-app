<div class="drop-shadow overflow-hidden border border-gray-200 sm:rounded-lg">
    <table class="w-full text-left divide-y divide-gray-200">
        <thead class="bg-gray-50">
            {{ $thead ?? '' }}
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>
