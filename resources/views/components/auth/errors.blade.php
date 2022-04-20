@if ($errors->any())
    <div class="p-4 mb-4 rounded-md bg-red-100">
        <div class="mb-2 text-sm font-semibold text-red-800">
            {{ __('There were :count errors with your submission', ['count' => $errors->count()]) }}
        </div>

        <ul class="list-disc list-inside text-xs sm:text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
