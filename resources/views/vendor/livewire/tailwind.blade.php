@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
<div class="mt-12 flex justify-center">
    <nav class="flex items-center space-x-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Prev</span>
        @else
            <button wire:click="previousPage"
                    class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-indigo-600 hover:text-white">
                Prev
            </button>
        @endif

        {{-- Page Links --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded border border-indigo-600 bg-indigo-600 text-white">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                                class="px-3 py-1 rounded border border-gray-300 hover:bg-indigo-600 hover:text-white">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage"
                    class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-indigo-600 hover:text-white">
                Next
            </button>
        @else
            <span class="px-3 py-1 rounded border border-gray-300 text-gray-400 cursor-not-allowed">Next</span>
        @endif

    </nav>
</div>
@endif
</div>
