@extends('backend.layouts.master')
@section('title', "Shippers")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách shipper</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'shipper_' => 'Tên',
                                    'shipper_status_code' => 'Trạng thái',
                                    'created_at' => 'Ngày tạo',
                                 ]
                             ])
                            <div class="col-12 w-100 d-flex justify-content-center">
                                <a href="{{route('admin.shippers.add')}}" class="btn btn-success w-100">
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
                                        Tên
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Số điện thoại
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
                                @if (!count($shippers))
                                    <tr>
                                        <td class="text-center" colspan="10">Không có shipper nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($shippers as $shipper)
                                    <tr>
                                        <td class="text-center">
                                            {{$shipper->id}}
                                        </td>
                                        <td>
                                            {{$shipper->shipper_name}}
                                        </td>
                                        <td class="{{$shipper->shipper_status_code?'text-success':'text-danger'}}" id="shipper-status">
                                            {{$shipper->name_status}}
                                        </td>
                                        <td>
                                            {{$shipper->shipper_phone}}
                                        </td>
                                        <td>
                                            {{$shipper->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$shipper->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            {{--<a href="#" rel="tooltip"--}}
                                               {{--class="btn btn-{{$shipper->status?'primary':'success'}} btn-icon btn-sm change-saler-status" data-id="{{$shipper->id}}">--}}
                                                {{--<i class="fa {{$shipper->status?'fa-minus':'fa-check'}}"></i>--}}
                                            {{--</a>--}}
                                            <a href="{{route('admin.shippers.edit', $shipper->id)}}" rel="tooltip"
                                               class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""
                                               title="">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {{--<button type="button" rel="tooltip"--}}
                                                    {{--class="btn btn-danger btn-icon btn-sm btn-remove-shipper--}}
{{--"--}}
                                                    {{--data-id="{{$shipper->id}}" title="">--}}
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
                        {{$shippers->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
