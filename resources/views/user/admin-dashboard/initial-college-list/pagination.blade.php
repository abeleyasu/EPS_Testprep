<nav aria-label="Simple Pagination">
    @if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item"><span class="page-link"><span aria-hidden="true">&laquo;</span></span></li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li lass="page-item"><span class="page-link">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a  class="page-link" aria-label="Next" href="{{ $paginator->nextPageUrl() }}">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item"><span class="page-link"><span aria-hidden="true">&raquo;</span></span></li>
        @endif
    </ul>
    @endif 
</nav>