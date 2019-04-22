@extends('frontend.layouts.default')

@section('content')
    <section id="cart-page">
        <div class="container">
            <!-- ========================================= CONTENT ========================================= -->
            <div class="col-xs-12 col-md-9 items-holder no-margin">
                @foreach ($carts as $cart)
                    <div class="row no-margin cart-item">
                        <div class="col-xs-12 col-sm-2 no-margin">
                            <a href="#" class="thumb-holder">
                                <img class="lazy" alt="" src="{{ asset('images/'.$cart->product->image) }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-sm-5 ">
                            <div class="title">
                                <a href="#">{{ $cart->product->name }}</a>
                            </div>
                            {{--<div class="brand">sony</div>--}}
                        </div>

                        <div class="col-xs-12 col-sm-3 no-margin">
                            <div class="quantity">
                                <div class="le-quantity">
                                    <a class="minus" href="{{ route('cart.minus.quantity', ['id' => $cart->id]) }}" data-id="{{ $cart->id }}"></a>
                                    <input name="quantity" readonly="readonly" type="text" value="{{ $cart->quantity }}">
                                    <a class="plus" href="{{ route('cart.add.quantity', ['id' => $cart->id]) }}" data-id="{{ $cart->id }}"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 no-margin">
                            <div class="price">
                                {{ number_format($cart->product->price * $cart->quantity) }} đ
                            </div>
                            <a class="close-btn" href="{{ route('cart.delete', ['id' => $cart->id]) }}"></a>
                        </div>
                    </div><!-- /.cart-item -->
                @endforeach
            </div>
            <!-- ========================================= CONTENT : END ========================================= -->

            <!-- ========================================= SIDEBAR ========================================= -->

            <div class="col-xs-12 col-md-3 no-margin sidebar ">
                <div class="widget cart-summary">
                    <h1 class="border">shopping cart</h1>
                    <div class="body">
                        <ul class="tabled-data no-border inverse-bold">
                            <li>
                                <label>cart subtotal</label>
                                <div class="value pull-right">{{ number_format($subtotal) }} đ</div>
                            </li>
                            <li>
                                <label>shipping</label>
                                <div class="value pull-right">free shipping</div>
                            </li>
                        </ul>
                        <ul id="total-price" class="tabled-data inverse-bold no-border">
                            <li>
                                <label>order total</label>
                                <div class="value pull-right">{{ number_format($subtotal) }} đ</div>
                            </li>
                        </ul>
                        <div class="buttons-holder">
                            <a class="le-button big" href="{{ route('cart.checkout') }}">checkout</a>
                            <a class="simple-link block" href="{{ route('shop') }}">continue shopping</a>
                        </div>
                    </div>
                </div><!-- /.widget -->

                {{--<div id="cupon-widget" class="widget">--}}
                    {{--<h1 class="border">use coupon</h1>--}}
                    {{--<div class="body">--}}
                        {{--<form>--}}
                            {{--<div class="inline-input">--}}
                                {{--<input data-placeholder="enter coupon code" type="text" class="placeholder">--}}
                                {{--<button class="le-button" type="submit">Apply</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div><!-- /.widget -->--}}
            </div><!-- /.sidebar -->

            <!-- ========================================= SIDEBAR : END ========================================= -->
        </div>
    </section>
@stop
@section('script')
    <script>
        $('.le-quantity .minus').click((e) => {
            // console.log($(e.target).attr('href'))
            const id = $(e.target).attr('href');
            window.location = id;
        })
        $('.le-quantity .plus').click(() => {
            const id = $(e.target).attr('href');
            window.location = id;
        })
    </script>
@stop
