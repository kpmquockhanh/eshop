@extends('backend.layouts.master_page')
@section('class-body', 'register-page')
@section('content')
    <div class="full-page register-page section-image" filter-color="black"
         data-image="../../assets/img/bg/jan-sendereks.jpg">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 ml-auto">
                        <div class="info-area info-horizontal mt-5">
                            <div class="icon icon-primary">
                                <i class="nc-icon nc-tv-2"></i>
                            </div>
                            <div class="description">
                                <h5 class="info-title">Xin chào</h5>
                                <p class="description">
                                    Hãy nhanh chóng đăng kí làm cộng tác viên của chúng tuôi ngay lào.
                                </p>
                            </div>
                        </div>
                        {{--<div class="info-area info-horizontal">--}}
                            {{--<div class="icon icon-primary">--}}
                                {{--<i class="nc-icon nc-html5"></i>--}}
                            {{--</div>--}}
                            {{--<div class="description">--}}
                                {{--<h5 class="info-title">Fully Coded in HTML5</h5>--}}
                                {{--<p class="description">--}}
                                    {{--We've developed the website with HTML5 and CSS3. The client has access to the code--}}
                                    {{--using GitHub.--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="info-area info-horizontal">--}}
                            {{--<div class="icon icon-info">--}}
                                {{--<i class="nc-icon nc-atom"></i>--}}
                            {{--</div>--}}
                            {{--<div class="description">--}}
                                {{--<h5 class="info-title">Built Audience</h5>--}}
                                {{--<p class="description">--}}
                                    {{--There is also a Fully Customizable CMS Admin Dashboard for this product.--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-lg-4 col-md-6 mr-auto">
                        <div class="card card-signup">
                            <form class="form" method="post" action="{{route('admin.register.post')}}" id="formRegister">
                                @csrf()

                                <div class="card-header">
                                    <h4 class="card-title">Admin Register</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="form-group has-label">
                                        <label>
                                            Name *
                                        </label>
                                        <input class="form-control" name="name" type="text" required="true">
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Email Address *
                                        </label>
                                        <input class="form-control" name="email" type="email" required="true">
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Password *
                                        </label>
                                        <input class="form-control" name="password" id="registerPassword" type="password" required="true">
                                    </div>
                                    <div class="form-group has-label">
                                        <label>
                                            Confirm Password *
                                        </label>
                                        <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalto="#registerPassword">
                                    </div>
                                    <div class="category form-category">* Required fields</div>
                                </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-info btn-round">Register</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.layouts.footer_page')
        <div class="full-page-background"
             style="background-image: url('{{asset('backend/img/bg/jan-sendereks.jpg')}}') "></div>
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
            {{--setFormValidation('#formRegister');--}}
        {{--});--}}
    {{--</script>--}}
{{--@stop--}}