@extends('layouts.master')
@section('breadcumb')
    @include('layouts.breadcumb')
@stop
@section('content')
    <div class="login-register-area pt-70 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                            <div class="login-register-form">
                            <form action="{{route('register')}}" method="post">
                            @csrf()
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                                <input type="text" name="name" placeholder="Name" value="{{old('name')}}">
                            @if ($errors->has('email'))
                            <div class="text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                            </div>
                            @endif
                            <input type="text" name="email" placeholder="Email" value="{{old('email')}}">
                            @if ($errors->has('password'))
                            <div class="text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                            </div>
                            @endif
                            <input type="password" name="password" placeholder="Password" value="{{old('password')}}">
                            <input type="password" name="password_confirmation" placeholder="Retype password">
                            <div class="button-box">
                                <button type="submit"><span>Register</span></button>
                                <span class="login-toggle-btn">
                                    <a href="{{route('login')}}" class="btn-switch float-right"><span>Login</span></a>
                                </span>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop