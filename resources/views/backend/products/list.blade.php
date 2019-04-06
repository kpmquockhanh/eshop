@extends('backend.layouts.master')
@section('title', "Flower list")
@section('content')
    <div class="content">
        <div class="row">
            @include('backend.layouts.search',
            [
               'queries' => $queries,
                'sorts' => [
                   'id' => 'id',
                   'views' => 'Lượt xem',
                   'show' => 'Hiển thị',
                   'name' => 'Tên',
                   'saleoff' => 'Giảm giá',
                   'price' => 'Giá',
                   'quantity' => 'Số lượng',
                   'created_at' => 'Ngày tạo',
                ]
            ])
            @if (!count($products))
                <div class="alert alert-info m-auto w-100">
                    Không có sản phẩm nào trong cơ sở dữ liệu.
                    <a href="{{route('admin.products.list')}}" class="text-light font-weight-bold">Quay lại trang chủ</a>
                    Hoặc
                    <a href="{{route('admin.products.add')}}" class="text-light font-weight-bold">Tạo mới</a>
                </div>
            @else
                <div class="col-12 row">
                    @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->status)
                        <div class="col-12">
                            <div class="row">
                                <div class="col-10 d-flex justify-content-center">
                                    <a href="{{route('admin.products.add')}}" class="btn btn-success w-100 pull-right" style="display: flex;justify-content: center;">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <a href="{{route('admin.products.list', ['list_type' => 'table'])}}" class="btn btn-info w-100 pull-right" style="display: flex;justify-content: center;">
                                        <i class="fa fa-list"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col-xl-4 col-lg-6 position-relative item-product">
                            <div class="card">
                                <div class="card-header">
                                    <h5 style="font-size: 15px">{{str_limit($product->name, $limit = 20, $end = '...')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul id="tabs" class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="tab"
                                                       href="#home{{$product->id}}" role="tab" aria-expanded="true"
                                                       aria-selected="true">Tổng quan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#profile{{$product->id}}"
                                                       role="tab" aria-expanded="false" aria-selected="false">Thông điệp</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#messages{{$product->id}}"
                                                       role="tab" aria-expanded="false" aria-selected="false">Chi tiết</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="my-tab-content" class="tab-content text-center" style="height: 300px;">
                                        <div class="tab-pane active show" id="home{{$product->id}}" role="tabpanel"
                                             aria-expanded="true">
                                            <div class=" position-relative">
                                                <img src="{{$product->image?asset('images/'.$product->image):asset('assets/admin/assets/img/image_placeholder.jpg')}}"
                                                     alt="" style="height: 250px;">
                                                {{--<div class="position-absolute w-100" style="bottom: 0px;left: 0px;">--}}
                                                {{--<div class="btn btn-danger w-100 m-0 rounded-bottom p-1"--}}
                                                {{--style="background-color: rgba(15,15,15,.5)">--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6 h5 m-0">{{number_format($product->price)}}--}}
                                                {{--đ--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6 h5 m-0">SL:--}}
                                                {{--<strong>{{$product->quantity}}</strong>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            {{--<p class="mt-2">{!! $product->message?str_limit(strip_tags($product->message), $limit = 50, $end = '...'):"Không có thông điệp." !!}</p>--}}
                                        </div>

                                        <div class="tab-pane" id="profile{{$product->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            <p>{!! $product->message?:"Không có thông điệp." !!}</p>
                                        </div>
                                        <div class="tab-pane" id="messages{{$product->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            {{--<p>Thông tin chi tiết đang được cập nhật</p>--}}
                                            <p class="m-0">Tên hoa: <strong>{{$product->name}}</strong></p>
                                            <p class="m-0">Giá: <strong>{{number_format($product->price)}}đ</strong></p>
                                            <p class="m-0">Số lượng: <strong>{{$product->quantity}}</strong></p>
                                            <p class="m-0">Thể loại:
                                                @foreach ($product->categories->load('category') as $key => $category)
                                                    @if ($key),@endif
                                                    <strong>{{($category->category->cate_name)}}</strong>
                                                @endforeach
                                            </p>
                                            <p class="m-0">Giảm giá: <strong>{{$product->sale}} </strong></p>
                                            <p class="m-0">Người đăng: <strong>{{$product->admin->name}}</strong></p>
                                            <p class="m-0">Ngày tạo: <strong>{{$product->created_at}}</strong></p>
                                            <p class="m-0">Ngày sửa: <strong>{{$product->updated_at}}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute" style="top: 0.2rem;right: 1.45rem;">

                                <button class="form-check btn {!! $product->show?'btn-primary':'' !!} btn-icon btn-sm trigger-change-status">
                                    <i class="fa fa-check " {!! $product->show?'':'style="display: none"' !!}></i>
                                    <input class="form-check-input change-show-status" type="checkbox"
                                           {{$product->show?'checked':''}} data-id="{{$product->id}}">
                                </button>

                                <a href="{{route('admin.products.edit', $product->id)}}" rel="tooltip"
                                   class="btn btn-success btn-icon btn-sm btn-edit" data-original-title="" title="">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm btn-remove"
                                        data-id="{{$product->id}}" title="">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$products->appends($queries)->links()}}
        </div>
    </div>
@stop
