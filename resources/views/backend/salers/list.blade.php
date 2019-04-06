@extends('backend.layouts.master')
@section('title', "Salers")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách saler</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'name' => 'Tên',
                                    'status' => 'Trạng thái',
                                    'type' => 'Kiểu',
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
                                        Tên
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Avatar
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Địa chỉ
                                    </th>
                                    <th>
                                        Kiểu tài khoản
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
                                @if (!count($salers))
                                    <tr>
                                        <td class="text-center" colspan="10">Không có tài khoản nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($salers as $saler)
                                    <tr>
                                        <td class="text-center">
                                            {{$saler->id}}
                                        </td>
                                        <td>
                                            {{$saler->name}}
                                        </td>
                                        <td>
                                            {{$saler->email}}
                                        </td>
                                        <td width="5vw">
                                            <img src="{{$saler->avatar?'/images/avatars/'.$saler->avatar:asset('backend/img/faces/ayo-ogunseinde-2.jpg')}}"/>
                                        </td>
                                        <td style="width: 10%;" class="{{$saler->status?'text-success':'text-danger'}}" id="saler-status">
                                            {{$saler->name_status}}
                                        </td>
                                        <td style="width: 10%;">
                                            {{$saler->location ?? "Không có"}}
                                        </td>
                                        <td>
                                            {{$saler->name_type}}
                                        </td>
                                        <td>
                                            {{$saler->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$saler->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                           @if ($saler->canChange())
                                                <a href="#" rel="tooltip"
                                                   class="btn btn-{{$saler->status?'primary':'success'}} btn-icon btn-sm change-saler-status mb-1" data-id="{{$saler->id}}">
                                                    <i class="fa {{$saler->status?'fa-minus':'fa-check'}}"></i>
                                                </a>
                                                <a href="{{route('admin.salers.edit', $saler->id)}}" rel="tooltip"
                                                   class="btn btn-success btn-icon btn-sm btn-edit mb-1" data-original-title=""
                                                   title="">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" rel="tooltip"
                                                        class="btn btn-danger btn-icon btn-sm btn-remove-saler mb-1"
                                                        data-id="{{$saler->id}}" title="">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                           @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$salers->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
