@extends('backend.layouts.master_page')
@section('class-body', 'login-page')
@section('content')
    <div class="wrapper wrapper-full-page ">
        <div class="full-page section-image" filter-color="black" data-image="../../assets/img/bg/fabio-mangione.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                        <form class="form" method="post" action="{{route('admin.login.post')}}" id="formlogin">
                            @csrf()
                            <div class="card card-login">
                                <div class="card-header ">
                                    <div class="card-header ">
                                        <h3 class="header text-center">Admin Login</h3>
                                    </div>
                                </div>

                                <div class="card-body ">
                                    @if($errors->first())
                                        <div class="text-white bg-danger py-2 mb-2 text-center">
                                                <strong>{{$errors->first()}}</strong>
                                        </div>
                                    @endif
                                        @if ($errors->has('email'))
                                            <div class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                        <div class="form-group has-label">
                                            <label>Email *</label>
                                            <input class="form-control" name="email" type="text" email="true" required="true" value="{{old('email')}}"/>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="text-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                        <div class="form-group has-label">
                                            <label>Password *</label>
                                            <input class="form-control" name="password" type="password" required="true" />
                                        </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" name="remeber" {{old('remember')?'checked':''}}>
                                                <span class="form-check-sign"></span>
                                                Remember
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-warning btn-round btn-block mb-3">Đăng nhập
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('backend.layouts.footer_page')
            <div class="full-page-background"
                 style="background-image: url({{asset('backend/img/bg/fabio-mangione.jpg')}}) "></div>
        </div>
    </div>
@stop
{{--@section('script')--}}
    {{--<script>--}}
        {{--function setFormValidation(id) {--}}
            {{--$(id).validate({--}}
                {{--highlight: function(element) {--}}
                    {{--$(element).closest('.form-group').removeClass('has-success').addClass('has-danger');--}}
                    {{--$(element).closest('.form-check').removeClass('has-success').addClass('has-danger');--}}
                {{--},--}}
                {{--success: function(element) {--}}
                    {{--$(element).closest('.form-group').removeClass('has-danger').addClass('has-success');--}}
                    {{--$(element).closest('.form-check').removeClass('has-danger').addClass('has-success');--}}
                {{--},--}}
                {{--errorPlacement: function(error, element) {--}}
                    {{--$(element).closest('.form-group').append(error);--}}
                {{--},--}}
            {{--});--}}
        {{--}--}}

        {{--$(document).ready(function() {--}}
            {{--setFormValidation('#formlogin');--}}
        {{--});--}}
    {{--</script>--}}
{{--@stop--}}
