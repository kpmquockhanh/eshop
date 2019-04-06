@extends('backend.layouts.master')
@section('title', "Payments")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách phương thức thanh toán </h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'payment_type' => 'Tên',
                                    'payment_allowed' => 'Trạng thái',
                                    'created_at' => 'Ngày tạo',
                                 ]
                             ])
                        <div class="col-md-2 m-auto pr-5">
                            <a href="{{route('admin.payments.add')}}" class="btn btn-success w-50 pull-right">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
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
                                        Kiểu
                                    </th>
                                    <th>
                                        Cho phép thanh toán
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
                                @if (!count($payments))
                                    <tr>
                                        <td class="text-center" colspan="10">Không có phương thức thanh toán nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="text-center">
                                            {{$payment->id}}
                                        </td>
                                        <td>
                                            {{$payment->payment_type}}
                                        </td>
                                        <td class="{{$payment->payment_allowed?'text-success':'text-danger'}}" id="shipper-status">
                                            {{$payment->name_status}}
                                        </td>
                                        <td>
                                            {{$payment->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$payment->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            {{--<a href="#" rel="tooltip"--}}
                                               {{--class="btn btn-{{$payment->status?'primary':'success'}} btn-icon btn-sm change-saler-status" data-id="{{$payment->id}}">--}}
                                                {{--<i class="fa {{$payment->status?'fa-minus':'fa-check'}}"></i>--}}
                                            {{--</a>--}}
                                            <a href="{{route('admin.payments.edit', $payment->id)}}" rel="tooltip"
                                               class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""
                                               title="">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {{--<button type="button" rel="tooltip"--}}
                                                    {{--class="btn btn-danger btn-icon btn-sm btn-remove-shipper--}}
{{--"--}}
                                                    {{--data-id="{{$payment->id}}" title="">--}}
                                                {{--<i class="fa fa-times"></i>--}}
                                            {{--</button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$payments->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
