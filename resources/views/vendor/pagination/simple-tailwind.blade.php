@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <x-button class="opacity-50">
                {!! __('pagination.previous') !!}
            </x-button>
        @else
            <x-button href="{{ $paginator->previousPageUrl() }}" rel="prev">
                {!! __('pagination.previous') !!}
            </x-button>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <x-button href="{{ $paginator->nextPageUrl() }}" rel="next">
                {!! __('pagination.next') !!}
            </x-button>
        @else
            <x-button class="opacity-50">
                {!! __('pagination.next') !!}
            </x-button>
        @endif
    </nav>
@endif
