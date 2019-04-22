@if (isset($carts))
    <div class="top-cart-holder dropdown animate-dropdown">
        <div class="basket">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                    <span class="count">{{ $carts->count() }}</span>
                    <img src="{{ asset('assets/images/icon-cart.png') }}" alt="" />
                </div>

                <div class="total-price-basket">
                    <span class="lbl">your cart:</span>
                    <span class="total-price">
                    <span class="value">{{ number_format($carts->sum(function ($item) {return $item->product->sale_price;})) }}</span>
                    <span class="sign">đ</span>
                </span>
                </div>
            </a>
            @if (\Illuminate\Support\Facades\Auth::guard('user')->check())
                <ul class="dropdown-menu">
                    @foreach (\App\Cart::getCart() as $cart)
                        <li>
                            <div class="basket-item">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 no-margin text-center">
                                        <div class="thumb">
                                            <img alt="" src="{{ asset('assets/images/products/product-small-01.jpg') }}" />
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 no-margin">
                                        <div class="title">{{ $cart->product->name }}</div>
                                        <div class="price">{{ number_format($cart->product->sale_price) }}</div>
                                    </div>
                                </div>
                                <a class="close-btn" href="{{ route('cart.delete', ['id' => $cart->id]) }}"></a>
                            </div>
                        </li>
                    @endforeach
                    <li class="checkout">
                        <div class="basket-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <a href="{{ route('cart.index') }}" class="le-button inverse">View cart</a>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <a href="checkout.html" class="le-button">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @if (!$carts->count())
                        <li class="text-center p-0">No items.</li>
                    @endif
                </ul>
            @endif

        </div><!-- /.basket -->
    </div><!-- /.top-cart-holder -->

@endif
