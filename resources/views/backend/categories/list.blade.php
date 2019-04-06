@extends('backend.layouts.master')
@section('title', "Thể loại")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách thể loại</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'cate_name' => 'Tên',
                                    'cate_code' => 'Mã',
                                    'created_at' => 'Ngày tạo',
                                 ]
                             ])

                            <div class="col-md-12">
                                <a href="{{route('admin.categories.add')}}" class="btn btn-success w-100">
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
                                        Mã
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
                                @if (!count($categories))
                                    <tr>
                                        <td class="text-center" colspan="6">Không có thể loại nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="text-center">
                                            {{$category->id}}
                                        </td>
                                        <td>
                                            {{$category->cate_name}}
                                        </td>
                                        <td>
                                            {{$category->cate_code}}
                                        </td>
                                        <td>
                                            {{$category->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            {{$category->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                           @if ($category->canChange())
                                                <a href="{{route('admin.categories.edit', $category->id)}}" rel="tooltip"
                                                   class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""
                                                   title="">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" rel="tooltip"
                                                        class="btn btn-danger btn-icon btn-sm btn-remove-category"
                                                        data-id="{{$category->id}}" title="">
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
                        {{$categories->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
