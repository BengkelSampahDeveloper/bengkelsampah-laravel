{{-- <div class="pagination-container">
    <div class="pagination-info" id="paginationInfo">
        {{ $artikels->firstItem() ?? 0 }}-{{ $artikels->lastItem() ?? 0 }} of {{ $artikels->total() }}
    </div>
    <div class="pagination" id="pagination">
        @if($artikels->onFirstPage())
            <button class="pagination-btn" disabled>&lt;</button>
        @else
            <button class="pagination-btn" onclick="changePage({{ $artikels->currentPage() - 1 }})">&lt;</button>
        @endif

        @if($artikels->hasMorePages())
            <button class="pagination-btn" onclick="changePage({{ $artikels->currentPage() + 1 }})">&gt;</button>
        @else
            <button class="pagination-btn" disabled>&gt;</button>
        @endif
    </div>
</div>  --}}