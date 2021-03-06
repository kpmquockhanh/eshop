@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Thêm phương thức thanh toán</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            {{--<input type="text" name="id" class="form-control" value="" hidden>--}}
                            <div class="row">
                                @if ($errors->has('payment_type'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Phương thức thanh toán</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="payment_type" class="form-control" value="{{old('payment_type')}}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Thêm phương thức</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-4">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header ">--}}
                            {{--<h4 class="card-title">Hình ảnh</h4>--}}
                        {{--</div>--}}
                        {{--<div class="card-body d-flex justify-content-center">--}}
                            {{--<div class="row">--}}

                                {{--<div class="col-md-12 m-auto">--}}
                                    {{--@if ($errors->has('image'))--}}
                                        {{--<div class="text-danger col-md-10">--}}
                                            {{--<strong>{{ $errors->first('image') }}</strong>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                    {{--<div class="fileinput fileinput-new text-center" data-provides="fileinput">--}}
                                        {{--<div class="fileinput-new thumbnail">--}}
                                            {{--<img src="{{asset('assets/admin/assets/img/image_placeholder.jpg')}}" alt="...">--}}
                                        {{--</div>--}}
                                        {{--<div class="fileinput-preview fileinput-exists thumbnail"></div>--}}
                                        {{--<div>--}}
                                        {{--<span class="btn btn-rose btn-round btn-file">--}}
                                          {{--<span class="fileinput-new">Chọn ảnh</span>--}}
                                          {{--<span class="fileinput-exists">Thay đổi</span>--}}
                                          {{--<input type="file" name="image" accept="image/*">--}}
                                        {{--</span>--}}
                                            {{--<a href="#" class="btn btn-danger btn-round fileinput-exists"--}}
                                               {{--data-dismiss="fileinput"><i class="fa fa-times"></i> Loại bỏ</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </form>
    </div>
@stop