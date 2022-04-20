<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="drop-shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                <table class="min-w-full table-auto text-left divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        {{ $thead ?? '' }}
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{ $slot }}
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
