@if ($paginator->hasPages())
    <div >
        <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item"><span>&laquo;</span></li>
        @else
            <li class="page-item"><a @click.prevent="axiosGetFiltered('?page={{$paginator->currentPage() - 1}}')" href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">&laquo;</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a v-on:click.prevent="axiosGetFiltered('?page={{ $page }}')" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
                <li class="page-item"><a v-on:click.prevent="axiosGetFiltered('?page={{$paginator->currentPage() + 1}}')" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
                <li class="page-item disabled"><span>&raquo;</span></li>
        @endif
    </div>
@endif