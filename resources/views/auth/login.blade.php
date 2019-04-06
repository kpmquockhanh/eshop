@extends('frontend.layouts.master')
@section('title','Đăng nhập / Đăng kí')
@section('content')
    <div class="main-container col1-layout wow bounceInUp animated" style="visibility: visible;">
        <div class="main container">
            <div class="row">
                <div class="col-sm-12" id="content">
                    <div class="col-main">

                        <div class="static-contain">
                            <div class="page-title">
                                <h2 class="entry-title">
                                    Đăng nhập / Đăng kí
                                </h2>
                            </div>

                            <div class="page-content">
                                <div class="woocommerce">

                                    <div class="u-columns col2-set" id="customer_login">

                                        <div class="u-column1 col-1">


                                            <h2>Đăng nhập</h2>

                                            <form class="woocommerce-form woocommerce-form-login login" method="post" action="{{route('login')}}">
                                                @csrf
                                                @if ($errors->first() && !old('name'))
                                                    <div class="text-danger">
                                                        <strong class="">{{ $errors->first() }}</strong>
                                                    </div>
                                                @endif

                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="username">Email&nbsp;<span class="required">*</span></label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="username" autocomplete="email" value="{{!old('name')?old('email'):''}}">			</p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="password">Mật khẩu&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password">
                                                </p>


                                                <p class="form-row">
                                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Ghi nhớ</span>
                                                    </label>
                                                    <button type="submit" class="woocommerce-Button button" value="Log in">Đăng nhập</button>
                                                </p>
                                                <p class="woocommerce-LostPassword lost_password">
                                                        <a href="#">Quên mật khẩu?</a>
                                                </p>


                                            </form>


                                        </div>

                                        <div class="u-column2 col-2">

                                            <h2>Đăng kí</h2>

                                            <form method="post" class="woocommerce-form woocommerce-form-register register" action="{{route('register')}}">
                                                @csrf
                                                @if ($errors->first() && old('name'))
                                                    <div class="text-danger">
                                                        <strong class="">{{ $errors->first() }}</strong>
                                                    </div>
                                                @endif
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="reg_email">Tên&nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="name" autocomplete="name" value="{{old('name')}}">
                                                </p>

                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="reg_email">Email&nbsp;<span class="required">*</span></label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" autocomplete="email" value="{{old('email')}}">
                                                </p>

                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="reg_password">Mật khẩu&nbsp;<span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" autocomplete="new-password" aria-autocomplete="list">
                                                </p>

                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="reg_password">Xác nhận mật khẩu <span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_confirmation"  autocomplete="new-password" aria-autocomplete="list">
                                                </p>


                                                <div class="woocommerce-privacy-policy-text"></div>
                                                <p class="woocommerce-FormRow form-row">
                                                    <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="ad799710bb">
                                                    <input type="hidden" name="_wp_http_referer" value="/creta/my-account/">
                                                    <button type="submit" class="woocommerce-Button button" name="register" value="Register">Đăng kí</button>
                                                </p>


                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- .entry-content -->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@stop