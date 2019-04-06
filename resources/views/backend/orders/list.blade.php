@extends('backend.layouts.master')
@section('title', "Orders")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách hóa đơn</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'transaction_status' => 'Tên',
                                    'ship_date' => 'Ngày vận chuyển',
                                    'payment_date' => 'ngày thanh toán',
                                    'total_price' => 'Tổng giá',
                                    'created_at' => 'Ngày tạo',
                                 ]
                             ])
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover" style="overflow: hidden;">
                            <table class="table">
                                <thead class="text-primary">
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>
                                        Người mua
                                    </th>
                                    <th>
                                        Thanh toán
                                    </th>
                                    <th>
                                        Tổng tiền
                                    </th>
                                    <th>
                                        Shipper
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Địa chỉ
                                    </th>
                                    <th>
                                        Ngày ship
                                    </th>
                                    <th>
                                        Ngày thanh toán
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
                                @if (!count($orders))
                                    <tr>
                                        <td class="text-center" colspan="12">Không có hóa đơn nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center">
                                            {{$order->id}}
                                        </td>
                                        <td>
                                            {{$order->user->name}}
                                        </td>
                                        <td>
                                            {{$order->payment->payment_type}}
                                        </td>
                                        <td>
                                            {{number_format($order->total_price)}} đ
                                        </td>
                                        <td>
                                            {{$order->shipper->shipper_name}}
                                        </td>
                                        <td>
                                            <div class="text-{{$order->status_text_color}}">{{$order->status}}</div>
                                        </td>
                                        <td>
                                            {{$order->address?:'Chưa có'}}
                                        </td>
                                        <td>
                                            {{$order->ship_date?:'Chưa có'}}
                                        </td>
                                        <td>
                                            {{$order->payment_date?:'Chưa có'}}
                                        </td>
                                        <td>
                                            {{$order->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$order->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.orders.view', ['id' => $order->id]) }}"
                                               class="btn btn-success btn-icon btn-sm btn-edit">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$orders->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
