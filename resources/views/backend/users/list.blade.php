@extends('backend.layouts.master')
@section('title', "Salers")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách user</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'name' => 'Tên',
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
                                        Thời gian tạo
                                    </th>
                                    <th>
                                        Thời gian sửa
                                    </th>
                                    {{--<th>--}}
                                        {{--Hành động--}}
                                    {{--</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($users))
                                    <tr>
                                        <td class="text-center" colspan="10">Không có tài khoản nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            {{$user->id}}
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td width="5vw">
                                            <img src="{{$user->avatar?'images/avatars/'.$user->avatar:asset('backend/img/faces/ayo-ogunseinde-2.jpg')}}"/>
                                        </td>
                                        <td>
                                            {{$user->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$user->updated_at->diffForHumans()}}
                                        </td>
                                        {{--<td>--}}
                                            {{--<a href="#" rel="tooltip"--}}
                                               {{--class="btn btn-{{$user->status?'primary':'success'}} btn-icon btn-sm change-saler-status" data-id="{{$user->id}}">--}}
                                                {{--<i class="fa {{$user->status?'fa-minus':'fa-check'}}"></i>--}}
                                            {{--</a>--}}
                                            {{--<a href="{{route('admin.salers.edit', $user->id)}}" rel="tooltip"--}}
                                               {{--class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""--}}
                                               {{--title="">--}}
                                                {{--<i class="fa fa-edit"></i>--}}
                                            {{--</a>--}}
                                            {{--<button type="button" rel="tooltip"--}}
                                                    {{--class="btn btn-danger btn-icon btn-sm btn-remove-saler"--}}
                                                    {{--data-id="{{$user->id}}" title="">--}}
                                                {{--<i class="fa fa-times"></i>--}}
                                            {{--</button>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$users->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
