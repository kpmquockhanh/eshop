
<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head'))
</head>

<body>
<div class="wrapper">
    @include('frontend.layouts.nav')

    @include('frontend.layouts.header')

    <main id="authentication" class="inner-bottom-md">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <section class="section sign-in inner-right-xs">
                        <h2 class="bordered">Sign In</h2>
                        <p>Hello, Welcome to your account</p>

                        <div class="social-auth-buttons">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-facebook"><i class="fa fa-facebook"></i> Sign In with Facebook</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-twitter"></i> Sign In with Twitter</button>
                                </div>
                            </div>
                        </div>

                        <form role="form" class="login-form cf-style-1" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="field-row">
                                <label>Email</label>
                                <input type="email" class="le-input" name="email" required>
                            </div><!-- /.field-row -->

                            <div class="field-row">
                                <label>Password</label>
                                <input type="password" class="le-input" name="password" required>
                            </div><!-- /.field-row -->

                            <div class="field-row clearfix">
                                <span class="pull-left">
                                    <label class="content-color"><input type="checkbox" class="le-checbox auto-width inline"> <span class="bold">Remember me</span></label>
                                </span>
                                <span class="pull-right">
                                    <a href="#" class="content-color bold">Forgotten Password ?</a>
                                </span>
                            </div>

                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">Sign In</button>
                            </div><!-- /.buttons-holder -->
                        </form><!-- /.cf-style-1 -->

                    </section><!-- /.sign-in -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <section class="section register inner-left-xs">
                        <h2 class="bordered">Create New Account</h2>
                        <p>Create your own Media Center account</p>

                        <form role="form" class="register-form cf-style-1" method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="field-row">
                                <label>Name</label>
                                <input type="text" class="le-input" name="name" required>
                            </div><!-- /.field-row -->
                            <div class="field-row">
                                <label>Email</label>
                                <input type="email" class="le-input" name="email" required>
                            </div><!-- /.field-row -->
                            <div class="field-row">
                                <label>Password</label>
                                <input type="password" class="le-input" name="password" required>
                            </div><!-- /.field-row -->
                            <div class="field-row">
                                <label>Confirm password</label>
                                <input type="password" class="le-input" name="password_confirmation" required>
                            </div><!-- /.field-row -->
                            <div class="buttons-holder">
                                <button type="submit" class="le-button huge">Sign Up</button>
                            </div><!-- /.buttons-holder -->
                        </form>

                        <h2 class="semi-bold">Sign up today and you'll be able to :</h2>

                        <ul class="list-unstyled list-benefits">
                            <li><i class="fa fa-check primary-color"></i> Speed your way through the checkout</li>
                            <li><i class="fa fa-check primary-color"></i> Track your orders easily</li>
                            <li><i class="fa fa-check primary-color"></i> Keep a record of all your purchases</li>
                        </ul>

                    </section><!-- /.register -->

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </main>

    {{--    @include('frontend.layouts.brands')--}}
    @include('frontend.layouts.footer')
</div><!-- /.wrapper -->

@include('frontend.layouts.script')
</body>
</html>
