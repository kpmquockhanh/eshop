@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{{ $saler->name }}</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <input type="text" name="id" class="form-control" value="{{$saler->id}}" hidden>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-2 text-center">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-center" value="{{$saler->id}}" disabled>
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{$saler->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Tên</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{$saler->name}}" disabled>
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('location'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="location" class="form-control" value="{{$saler->location}}" disabled>
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('status'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <span class="btn-group bootstrap-select p-0 col-md-3">
                                           <select class="selectpicker" data-size="7" data-style="btn btn-primary"
                                                                            title="Sắp xếp theo" tabindex="-98" id="" name="status" disabled="">
                                            <option class="bs-title-option" value="">Trạng thái</option>
                                            <option value="0" {{!$saler->status?'selected':''}} class="text-danger">Vô hiệu hóa</option>
                                            <option value="1" {{!$saler->status?'':'selected'}} class="text-success">Kích hoạt</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('type'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </div>
                                @endif
                                @if ($saler->type == 3)
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <span class="btn-group bootstrap-select p-0 col-md-3">
                                           <select class="selectpicker" data-size="7" data-style="btn btn-info"
                                                   title="Sắp xếp theo" tabindex="-98" id="" name="type" disabled>
                                            <option class="bs-title-option" value="">Trạng thái</option>
                                            <option value="1" {{$saler->type == 1 ?'selected':''}} class="text-success">Saler</option>
                                            <option value="2" {{$saler->type == 2 ?'selected':''}} class="text-primary" >Developer</option>

                                               <option value="3" {{$saler->type == 3 ?'selected':''}} class="text-danger">Admin</option>

                                        </select>
                                        </span>
                                    </div>
                                </div>
                                @endif
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
                                            <img src="{{$saler->avatar?asset('images/avatars/'.$saler->avatar):asset('backend/img/image_placeholder.jpg')}}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                        {{--<span class="btn btn-rose btn-round btn-file">--}}
                                          {{--<span class="fileinput-new">Chọn ảnh</span>--}}
                                          {{--<span class="fileinput-exists">Thay đổi</span>--}}
                                          {{--<input type="file" name="image" accept="image/*">--}}
                                        {{--</span>--}}
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
