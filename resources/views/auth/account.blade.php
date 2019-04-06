@extends('layouts.master')
@section('breadcumb')
    @include('layouts.breadcumb')
@stop
@section('content')
    <div class="checkout-area pb-55 pt-75">
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-auto col-lg-9">
                    <div class="checkout-wrapper">
                        <div id="faq" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>1</span>
                                        <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Sửa thông tin tài khoản </a>
                                    </h5>
                                </div>
                                <div id="my-account-1" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <form action="{{route('change-info')}}" method="post">
                                                @csrf()
                                                <div class="account-info-wrapper">
                                                    <h4>Thông tin tài khoản</h4>
                                                    <h5>Chi tiết tài khoản</h5>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Tên</label>
                                                            <input type="text" name="name"
                                                                   value="{{old('name', $user->name)}}">

                                                        </div>
                                                        @if ($errors->has('name'))
                                                            <div class="text-danger mb-2">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Email</label>
                                                            <input type="email" value="{{$user->email}}" disabled>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>
                                                    <div class="billing-btn">
                                                        <button type="submit">Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq"
                                                                              href="#my-account-2">Change your
                                            password </a></h5>
                                </div>
                                <div id="my-account-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <form action="{{route('change-pass')}}" method="post">
                                                @csrf()
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password</label>
                                                        <input type="password" name="password">
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <div class="text-danger mb-3">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </div>
                                                    @endif
                                                    <div class="billing-info">
                                                        <label>Password</label>
                                                        <input type="password" name="password">
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <div class="text-danger mb-3">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="password_confrmation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit">Change</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq"
                                                                              href="#my-account-3">Modify your address
                                            book entries </a></h5>
                                </div>
                                <div id="my-account-3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Address Book Entries</h4>
                                            </div>
                                            <div class="entries-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="entries-info text-center">
                                                            <p>Farhana hayder (shuvo) </p>
                                                            <p>hastech </p>
                                                            <p> Road#1 , Block#c </p>
                                                            <p> Rampura. </p>
                                                            <p>Dhaka </p>
                                                            <p>Bangladesh </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="entries-edit-delete text-center">
                                                            <a class="edit" href="#">Edit</a>
                                                            <a href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>4</span> <a href="wishlist.html">Modify your wish
                                            list </a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop