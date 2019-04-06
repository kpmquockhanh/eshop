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

            <div class="card-body">
                @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->status)
                    <div class="row">
                        <div class="col-10 d-flex justify-content-center">
                            <a href="{{route('admin.products.add')}}" class="btn btn-success w-100 pull-right" style="display: flex;justify-content: center;">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="{{route('admin.products.list', ['list_type' => 'grid'])}}" class="btn btn-info w-100 pull-right" style="display: flex;justify-content: center;">
                                <i class="fa fa-th-large"></i>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive table-hover" style="overflow: hidden;">
                    <table class="table">
                        <thead class="text-primary">
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>
                                Tên
                            </th>
                            <th>
                                Ảnh
                            </th>
                            <th>
                                Thông điệp
                            </th>
                            <th>
                                Người tạo
                            </th>
                            <th>
                                Lượt xem
                            </th>
                            <th>
                                Giá
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Thời gian tạo
                            </th>
                            <th>
                                Thời gian sửa
                            </th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!count($products))
                            <tr>
                                <td class="text-center" colspan="12">Không có sản phẩm nào trong cơ sở dữ
                                    liệu
                                </td>
                            </tr>
                        @endif
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">
                                    {{$product->id}}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td width="15%">
                                    <img src="{{ '/images/'.$product->image }}" alt="">
                                </td>
                                <td>
                                    {!! str_limit($product->message, 100) !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.salers.view', ['id' => $product->admin->id]) }}">{{ $product->admin->name }}</a>
                                </td>
                                <td>
                                    {{ $product->views }}
                                </td>
                                <td>
                                    {{ number_format($product->salePrice) }}đ ({{ $product->sale }})
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>
                                    {{ $product->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    {{ $product->updated_at->diffForHumans() }}
                                </td>
                                <td class="text-center">
                                    <button class="form-check btn {!! $product->show?'btn-primary':'' !!} btn-icon btn-sm trigger-change-status my-1">
                                        <i class="fa fa-check " {!! $product->show?'':'style="display: none"' !!}></i>
                                        <input class="form-check-input change-show-status" type="checkbox"
                                               {{$product->show?'checked':''}} data-id="{{$product->id}}">
                                    </button>

                                    <a href="{{route('admin.products.edit', $product->id)}}" rel="tooltip"
                                       class="btn btn-success btn-icon btn-sm btn-edit my-1" data-original-title="" title="">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm btn-remove my-1"
                                            data-id="{{$product->id}}" title="">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$products->appends($queries)->links()}}
        </div>
    </div>
@stop
