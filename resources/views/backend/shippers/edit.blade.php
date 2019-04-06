@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="{{route('admin.shippers.update')}}" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Chỉnh sửa người vận chuyển</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <input type="text" name="id" class="form-control" value="{{$shipper->id}}" hidden>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-2 text-center">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control text-center" value="{{$shipper->id}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('shipper_name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('shipper_name') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Tên</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="shipper_name" class="form-control" value="{{$shipper->shipper_name}}">
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('shipper_phone'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('shipper_phone') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Điện thoại</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="shipper_phone" class="form-control" value="{{$shipper->shipper_phone}}">
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('shipper_status_code'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('shipper_status_code') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <span class="btn-group bootstrap-select p-0 col-md-5">
                                           <select class="selectpicker w-100" data-size="7" data-style="btn btn-primary" name="shipper_status_code">
                                                <option class="bs-title-option" value="">Trạng thái</option>
                                                <option value="0" {{!$shipper->shipper_status_code?'selected':''}} class="text-danger">Không khả dụng</option>
                                                <option value="1" {{!$shipper->shipper_status_code?'':'selected'}} class="text-success">Khả dụng</option>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title">Hình ảnh</h4>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-12 m-auto">
                                    @if ($errors->has('avatar'))
                                        <div class="text-danger col-md-12">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </div>
                                    @endif
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{$shipper->avatar?asset('images/'.$shipper->image):asset('backend/img/placeholder.jpg')}}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                          <span class="fileinput-new">Chọn ảnh</span>
                                          <span class="fileinput-exists">Thay đổi</span>
                                          <input type="file" name="image" accept="image/*">
                                        </span>
                                            <a href="#" class="btn btn-danger btn-round fileinput-exists"
                                               data-dismiss="fileinput"><i class="fa fa-times"></i> Loại bỏ</a>
                                        </div>
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