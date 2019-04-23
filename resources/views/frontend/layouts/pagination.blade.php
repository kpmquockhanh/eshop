
@if ($paginator->lastPage() > 1)
    <div class="pagination-holder">
        <div class="row">
            <div class="col-xs-12 col-sm-6 text-left">
                <ul class="pagination ">
                    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}"><a href="#">prev</a></li>
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        <li class="{{ ($paginator->currentPage() == $i) ? ' current' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>

                    @endfor
                    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}"><a href="{{ $paginator->url($paginator->currentPage()+1) }}">next</a></li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="result-counter">
                    Showing <span>{{ 1 + $paginator->perPage()*($paginator->currentPage() - 1) }}-{{ 1 + $paginator->perPage()-1 + $paginator->perPage()*($paginator->currentPage() - 1) }}</span> of <span>{{ $paginator->total() }}</span> results
                </div>
            </div>

        </div><!-- /.row -->
    </div><!-- /.pagination-holder -->
@endif
