@if ($paginator->hasPages())

<ul class="pagination" role="navigation">
    {{-- First Page Link --}}
    <!-- 最初のページへのリンク -->
    <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a>
    </li>
    {{-- Previous Page Link --}}
    <!-- 前のページへのリンク -->
    <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
    </li>
    {{-- Pagination Elemnts --}}
    
    {{-- Array Of Links --}}
    <!-- それぞれのページへのリンク -->
    {{-- 定数よりもページ数が多い時 --}}
    @if ($paginator->lastPage() > config('const.PAGINATE.LINK_NUM'))
        <?php $end_page = config('const.PAGINATE.END_NUM');?>
    {{-- 定数よりもページ数が少ない時 --}}
    @else
        <?php $end_page = $paginator->lastPage(); ?>
    @endif
    {{-- 処理部分 --}}
    @for ($i = 1; $i <= $end_page; $i++)
        @if ($i == $paginator->currentPage())
            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
    @endfor
    {{-- Next Page Link --}}
    <!-- 次のページへのリンク -->
    <li class="page-item {{ $paginator->currentPage() == $end_page ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
    </li>
    {{-- Last Page Link --}}
    <!-- 最後のページへのリンク -->
    <li class="page-item {{ $paginator->currentPage() == $end_page ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($end_page) }}">&raquo;</a>
    </li>
</ul>
@endif