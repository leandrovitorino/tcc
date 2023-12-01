<!--Previous Page Link-->
<ul class="pagination justify-content-center">
    @if (!$paginator->onFirstPage())
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">Anterior</a></li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item"><span>{{ $element }}</span></li>
        @endif

        <!-- Array of Elements -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next page link -->
    @if ($paginator->hasMorePages())
        <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">Próxima</a></li>
    @endif
</ul>
