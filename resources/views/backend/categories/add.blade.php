@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Thêm thể loại</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            {{--<input type="text" name="id" class="form-control" value="" hidden>--}}
                            <div class="row">
                                @if ($errors->has('cate_name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('cate_name') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Tên thể loại</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="cate_name" class="form-control" value="{{old('cate_name')}}">
                                        
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
                                               value="{{old('cate_code')}}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('order'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Sắp xếp</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="number" name="order" class="form-control"
                                               value="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('show_home'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('show_home') }}</strong>
                                    </div>
                                @endif
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="1" name="show_home">
                                                <span class="form-check-sign"></span>
                                                Hiển thị
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Thêm thể loại</button>
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
