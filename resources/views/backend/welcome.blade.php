@extends('layouts.home.master')
@section('body_class', 'lock-page')
@section('content')
    @include('layouts.home.navbar')
    <div class="wrapper wrapper-full-page " style="background: url('{{asset('img/bg/bruno-abatti.jpg')}}') no-repeat center center; background-size: cover">
        <div class="full-page lock-page section-image">
            <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="col-lg-6 col-md-6 ml-auto mr-auto">
                        <div class="card card-lock text-center">
                            <div class="card-header ">
                                <img src="{{asset('img/faces/joe-gardner-2.jpg')}}" alt="...">
                            </div>
                            <div class="card-body ">
                                <h2 class="card-title mb-4">Auto system v1.0</h2>
                                <h3 class="card-title mb-4 text-danger">Welcome back!</h3>
                            </div>
                            {{--<div class="card-footer ">--}}
                                {{--<a href="#pablo" class="btn btn-outline-default btn-round">Unlock</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection