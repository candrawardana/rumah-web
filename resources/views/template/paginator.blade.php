<div class="pagination-cw">
@if ($paginator->hasPages())
    <ul class="pagination-2">
       
        @if ($paginator->onFirstPage())
            <li class="page-number prev disable">&laquo;</li>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><li class="page-number prev">&laquo;</li></a>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="page-number disable">{{ $element }}</li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-number active">{{ $page }}</li>
                    @else
                        <a href="{{ $url }}"><li class="page-number">{{ $page }}</li></a>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><li class="page-number prev">&raquo;</li></a>
        @else
            <li class="page-number prev disable">&raquo;</li>
        @endif
    </ul>
@endif
</div>