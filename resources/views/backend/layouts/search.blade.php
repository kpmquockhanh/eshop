<div class="col-md-12 row no-gutters">
    <form action="" class="m-0 d-flex align-items-center w-100 justify-content-between">
       <span class="btn-group bootstrap-select m-0 d-flex align-items-center col-md-3 pl-0">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary"
                   title="Sắp xếp theo" tabindex="-98" id="paginate" name="paginate">
              <option class="bs-title-option" value="">Phân trang</option>
              <option value="1" {{isset($queries['paginate'])?$queries['paginate'] == '1'?'selected':'':''}}>1 item / page</option>
              <option value="4" {{isset($queries['paginate'])?$queries['paginate'] == '4'?'selected':'':''}}>4 items / page</option>
              <option value="8" {{isset($queries['paginate'])?$queries['paginate'] == '8'?'selected':'':''}}>8 items / page</option>
              <option value="12" {{isset($queries['paginate'])?$queries['paginate'] == '12'?'selected':'':''}}>12 items / page</option>
              <option value="16" {{isset($queries['paginate'])?$queries['paginate'] == '16'?'selected':'':''}}>16 items / page</option>
              <option value="100" {{isset($queries['paginate'])?$queries['paginate'] == '100'?'selected':'':''}}>100 items / page</option>
           </select>
       </span>
        <span class="btn-group bootstrap-select m-0 d-flex align-items-center col-md-3">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary" title="Sắp xếp theo" tabindex="-98" id="sort" name="sort">
              <option class="bs-title-option" value="" >Sắp xếp theo</option>
              @foreach ($sorts as $col => $name)
                   <option value="{{ $col }}" {{isset($queries['sort'])?$queries['sort'] == $col?'selected':'':''}}>{{ $name }}</option>
              @endforeach
           </select>
        </span>
        <span class="input-group no-border m-0 p-0 col-md-6">
          <input type="text" value="{{isset($queries['search'])?$queries['search']:''}}"
                 class="form-control" placeholder="Search..." name="search">
          <div class="input-group-append">
             <div class="input-group-text">
                <i class="nc-icon nc-zoom-split"></i>
             </div>
          </div>
          <button type="submit" hidden></button>
        </span>
    </form>
</div>
