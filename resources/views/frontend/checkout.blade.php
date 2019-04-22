@extends('frontend.layouts.default')

@section('content')
    <section id="checkout-page">
        <div class="container">
            <div class="col-xs-12 no-margin">

                <form action="{{ route('cart.checkout.add') }}" method="post">
                    @csrf
                    @if ($errors->first())
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first() }}</div>
                    @endif
                    <div class="billing-address">
                        <h2 class="border h1">billing address</h2>
                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>full name*</label>
                                <input class="le-input" name="name">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>address*</label>
                                <input class="le-input placeholder" data-placeholder="street address" name="address">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">

                            <div class="col-xs-12 col-sm-4">
                                <label>email address*</label>
                                <input class="le-input" name="billing_email">
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <label>phone number*</label>
                                <input class="le-input" name="phone">
                            </div>
                        </div><!-- /.field-row -->
                    </div><!-- /.billing-address -->

                    <section id="your-order">
                        <h2 class="border h1">your order</h2>
                        @foreach ($carts as $cart)
                            <div class="row no-margin order-item">
                                <div class="col-xs-12 col-sm-1 no-margin">
                                    <a href="#" class="qty">{{ $cart->quantity }} x</a>
                                </div>

                                <div class="col-xs-12 col-sm-9 ">
                                    <div class="title"><a href="#">{{ $cart->product->name }}</a></div>
                                    @if ($cart->product->categories->count())
                                        <div class="brand">
                                            {{
                                                $cart->product->categories->reduce(function ($carry, $cate) {
                                                    if ($carry) {
                                                    return $carry.', '.$cate->cate_name;
                                                    } return $carry.$cate->cate_name;
                                                })
                                            }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-sm-2 no-margin">
                                    <div class="price">{{ number_format($cart->product->sale_price) }} đ</div>
                                </div>
                            </div><!-- /.order-item -->
                        @endforeach
                    </section><!-- /#your-order -->

                    <div id="total-area" class="row no-margin">
                        <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                            <div id="subtotal-holder">
                                <ul class="tabled-data inverse-bold no-border">
                                    <li>
                                        <label>cart subtotal</label>
                                        <div class="value ">{{ number_format($subtotal) }} đ</div>
                                    </li>
                                    <li>
                                        <label>shipping</label>
                                        <div class="value">
                                            <div class="radio-group">
                                                @foreach ($shippers as $shipper)
                                                    <input class="le-radio" type="radio" name="shipping_method" value="{{ $shipper->id }}">
                                                    <i class="fake-box"></i>
                                                    <div class="radio-label bold">{{ $shipper->shipper_name }}</div><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                </ul><!-- /.tabled-data -->

                                <ul id="total-field" class="tabled-data inverse-bold ">
                                    <li>
                                        <label>order total</label>
                                        <div class="value">{{ number_format($subtotal) }} đ</div>
                                    </li>
                                </ul><!-- /.tabled-data -->

                            </div><!-- /#subtotal-holder -->
                        </div><!-- /.col -->
                    </div><!-- /#total-area -->

                    <div id="payment-method-options">
                        @foreach ($payments as $payment)
                            <div class="payment-method-option">
                                <input class="le-radio" type="radio" name="payment_method" value="{{ $payment->id }}"><i class="fake-box"></i>
                                <div class="radio-label bold ">{{ $payment->payment_type }}<br>
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum tempus elit, vestibulum vestibulum erat ornare id.</p>--}}
                                </div>
                            </div><!-- /.payment-method-option -->
                        @endforeach
                    </div><!-- /#payment-method-options -->

                    <div class="place-order-button">
                        <button class="le-button big" type="submit">place order</button>
                    </div><!-- /.place-order-button -->
                </form>

            </div><!-- /.col -->
        </div><!-- /.container -->
    </section>
@stop
