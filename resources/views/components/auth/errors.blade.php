@if ($errors->any())
    <div>
        <div class="font-medium text-red-600">
            {{ __('Some errors found') }}
        </div>

        <ul class="my-4 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
