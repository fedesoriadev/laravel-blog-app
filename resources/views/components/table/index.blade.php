<div class="drop-shadow overflow-x-auto border border-gray-200 sm:rounded-lg">
    <table class="w-full table-auto text-left divide-y divide-gray-200">
        <thead class="bg-gray-50">
            {{ $thead ?? '' }}
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>
