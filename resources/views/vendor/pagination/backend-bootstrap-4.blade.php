@if ($paginator->hasPages())
    <ul class="pagination heloo" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="#" aria-controls="table_main" class="page-link"><i class="la la-angle-left"></i></a>
            </li>
        @else
            <li class="paginate_button page-item previous">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="la la-angle-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="paginate_button page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next">
                <a class="paginate_button page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="la la-angle-right"></i></a>
            </li>
        @else
            <li class="paginate_button page-item next disabled" >
                <a class="paginate_button page-link" href="#" ><i class="la la-angle-right"></i></a>
            </li>
        @endif
    </ul>
@endif
