@if ($paginator->hasPages())
    <?php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        // Tampilkan maksimal 4 angka halaman
        $startPage = max(1, $currentPage - 1);
        $endPage = min($lastPage, $startPage + 3);
        if ($endPage - $startPage < 3) {
            $startPage = max(1, $endPage - 3);
        }
    ?>
    <ul class="pagination custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
        @endif

        {{-- Max 4 Page Numbers --}}
        @for ($i = $startPage; $i <= $endPage; $i++)
            @if ($i == $currentPage)
                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
@endif
