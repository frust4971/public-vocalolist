
@if ($paginator->hasPages())

<ul class="pagination" role="navigation">
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
</ul>
@endif