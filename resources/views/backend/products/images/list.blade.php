@extends('backend.layouts.master')
@section('title', "Danh sách ảnh")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách ảnh đã upload</h4>
                        <div class="row">
                            <div class="col-md-10 row no-gutters">
                                <form action="" class="m-0 d-flex justify-content-around align-items-center w-100">
                    <span class="btn-group bootstrap-select m-0 d-flex align-items-center col-md-3">
                       <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round"
                               title="Sắp xếp theo" tabindex="-98" id="paginate" name="paginate">
                          <option class="bs-title-option" value="">Phân trang</option>
                          <option value="1" {{isset($queries['paginate'])?$queries['paginate'] == '1'?'selected':'':''}}>1 item / page</option>
                          <option value="5" {{isset($queries['paginate'])?$queries['paginate'] == '5'?'selected':'':''}}>5 items / page</option>
                          <option value="5" {{isset($queries['paginate'])?$queries['paginate'] == '20'?'selected':'':''}}>20 items / page</option>
                          <option value="50" {{isset($queries['paginate'])?$queries['paginate'] == '50'?'selected':'':''}}>50 items / page</option>
                          <option value="100" {{isset($queries['paginate'])?$queries['paginate'] == '100'?'selected':'':''}}>100 items / page</option>
                       </select>
                    </span>
                                    <span class="input-group no-border m-0 col-md-6">
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
                            <div class="col-md-2 m-auto pr-5">
                                <a href="#" class="btn btn-success pull-right btn-compress-all w-100 px-3" style="display: flex;justify-content: center;">
                                    <i class="fa fa-cogs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover" style="overflow: hidden;">
                            <table class="table">
                                <thead class="text-primary">
                                <tr>
                                    <th>
                                        Tên
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Size
                                    </th>
                                    <th>
                                        Hành động
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($images))
                                    <tr>
                                        <td class="text-center" colspan="6">Không có ảnh nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($images as $image)
                                    <tr>
                                        <td>
                                            {{$image->image}}
                                        </td>
                                        <td>
                                            <img src="/{{'images/'.$image->image}}" alt="" style="width: 5vw;">
                                        </td>
                                        <td>
                                            @php
                                            try{
                                            echo round(Intervention\Image\Facades\Image::make('images/'.$image->image)->filesize()/1024, 1).' KB';
                                            }catch (\Exception $e){echo "Có lỗi xảy ra";}
                                             @endphp
                                        </td>
                                        <td class="text-center">
                                            <a href="#" rel="tooltip"
                                               class="btn-lg btn-success btn-icon btn-sm btn-optimize-image" data-id="{{$image->id}}"
                                               title="">
                                                <i class="fa fa-cog fa-spin"></i>
                                                {{--<i class="fas fa-spinner fa-spin"></i>--}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$images->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
