@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="{{route('admin.categories.update')}}" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Chỉnh sửa thể loại</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <input type="text" name="id" class="form-control" value="{{$category->id}}" hidden>
                            <div class="row">
                                @if ($errors->has('cate_name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('cate_name') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Tên thể loại</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="cate_name" class="form-control" value="{{old('cate_name', $category->cate_name)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('cate_code'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('cate_code') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Mã thể loại</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="cate_code" class="form-control"
                                               value="{{old('cate_code',$category->cate_code)}}">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Sửa thể loại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop