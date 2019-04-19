@extends('backend.layouts.master')

@section('style')
    <!-- Include Editor style. -->
    <link href="{{asset('floara/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('floara/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        a[href="https://froala.com/wysiwyg-editor"], a[href="https://www.froala.com/wysiwyg-editor?k=u"] {
            display: none !important;
        }
    </style>
@stop

@section('content')

    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Thêm sản phẩm</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            {{--<input type="text" name="id" class="form-control" value="" hidden>--}}
                            <div class="row">
                                @if ($errors->has('name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('message'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Thông điệp</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea type="text" name="message"
                                                  class="form-control">{{old('message')}}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('saleoff'))
                                <div class="text-danger col-md-12 offset-md-2 p-0">
                                    <strong>{{ $errors->first('saleoff') }}</strong>
                                </div>
                            @endif
                            @if ($errors->has('price'))
                                <div class="text-danger col-md-12 offset-md-2 p-0">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </div>
                            @endif
                            @if ($errors->has('quantity'))
                                <div class="text-danger col-md-12 offset-md-2 p-0">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Giảm giá</label>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="saleoff" class="form-control"
                                               value="{{old('saleoff')}}" placeholder="VD: 0.1, 0.15,..." step="0.01">
                                        
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label">Giá</label>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control" value="{{old('price')}}">

                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label">Số lượng</label>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="quantity" class="form-control"
                                               value="{{old('quantity')}}">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 checkbox-radios">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="show"
                                                   type="checkbox" >
                                            <span class="form-check-sign"></span>
                                            Hiển thị
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Thể loại</label>
                                <div class="col-lg-5 col-md-6 col-sm-3">
                                    <select class="selectpicker" data-style="btn btn-info btn-round" multiple title="Thể loại" data-size="7" name="categories[]">
                                        @if ($categories->count())
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->cate_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
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
                                    @if ($errors->has('image'))
                                        <div class="text-danger col-md-10">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </div>
                                    @endif
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{asset('backend/img/image_placeholder.jpg')}}" alt="...">
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

@section('script')
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="{{asset('floara/js/froala_editor.pkgd.min.js')}}"></script>

    <!-- Initialize the editor. -->
    <script>
        $(function() {
            $('textarea').froalaEditor({
                heightMin: 200,
                spellcheck: false,
                language: 'vi'
            })
        });
    </script>

@stop
