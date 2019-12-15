@if ($paginator->hasPages())
    <div class="page-navigation">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="arrow left"></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="javascript:void(0)" class="dots">···</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <span class="active">{{ $page }}</span>
                        @else
                        <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="arrow right"></a>
            @endif
    </div>
@endif
