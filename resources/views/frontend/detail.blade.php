@extends('frontend.layouts.default')

@section('content')
    <div class="animate-dropdown">
        <!-- ========================================= BREADCRUMB ========================================= -->
        <div id="top-mega-nav">
            <div class="container">
                <nav>
                    <ul class="inline">
                        <li class="dropdown le-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i> shop by department
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Computer Cases &amp; Accessories</a></li>
                                <li><a href="#">CPUs, Processors</a></li>
                                <li><a href="#">Fans, Heatsinks &amp; Cooling</a></li>
                                <li><a href="#">Graphics, Video Cards</a></li>
                                <li><a href="#">Interface, Add-On Cards</a></li>
                                <li><a href="#">Laptop Replacement Parts</a></li>
                                <li><a href="#">Memory (RAM)</a></li>
                                <li><a href="#">Motherboards</a></li>
                                <li><a href="#">Motherboard &amp; CPU Combos</a></li>
                                <li><a href="#">Motherboard Components</a></li>
                            </ul>
                        </li>

                        <li class="breadcrumb-nav-holder">
                            <ul>
                                <li class="breadcrumb-item current">
                                    <a href="#">{{ $product->name }}</a>
                                </li>
                                <!-- /.breadcrumb-item -->
                            </ul>
                        </li>
                        <!-- /.breadcrumb-nav-holder -->
                    </ul>
                </nav>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#top-mega-nav -->
        <!-- ========================================= BREADCRUMB : END ========================================= -->
    </div>
    <div id="single-product">
        <div class="container">

            <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="owl-single-product" class="owl-carousel owl-loaded owl-drag">
                        <!-- /.single-product-gallery-item -->

                        <!-- /.single-product-gallery-item -->

                        <!-- /.single-product-gallery-item -->
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1044px;">
                                <div class="owl-item active" style="width: 348px;">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-rel="prettyphoto" href="{{ asset('images/'.$product->image) }}">
                                            <img class="img-responsive" alt="" src="{{ asset('images/'.$product->image) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 348px;">
                                    <div class="single-product-gallery-item" id="slide2">
                                        <a data-rel="prettyphoto" href="{{ asset('images/'.$product->image) }}">
                                            <img class="img-responsive" alt="" src="{{ asset('images/'.$product->image) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 348px;">
                                    <div class="single-product-gallery-item" id="slide3">
                                        <a data-rel="prettyphoto" href="{{ asset('images/'.$product->image) }}">
                                            <img class="img-responsive" alt="" src="{{ asset('images/'.$product->image) }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav disabled">
                            <div class="owl-prev">prev</div>
                            <div class="owl-next">next</div>
                        </div>
                        <div class="owl-dots">
                            <div class="owl-dot active"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                            <div class="owl-dot"><span></span></div>
                        </div>
                    </div>
                    <!-- /.single-product-slider -->

                    <div class="single-product-gallery-thumbs gallery-thumbs">

                        <div id="owl-single-product-thumbnails" class="owl-carousel owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 522px;">
                                    <div class="owl-item active" style="width: 58px;">
                                        <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
                                            <img width="67" alt="" src="{{ asset('images/'.$product->image) }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav disabled">
                                <div class="owl-prev">prev</div>
                                <div class="owl-next">next</div>
                            </div>
                            <div class="owl-dots">
                                <div class="owl-dot active"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                            </div>
                        </div>
                        <!-- /#owl-single-product-thumbnails -->

                        <div class="nav-holder left hidden-xs">
                            <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
                        </div>
                        <!-- /.nav-holder -->

                        <div class="nav-holder right hidden-xs">
                            <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
                        </div>
                        <!-- /.nav-holder -->

                    </div>
                    <!-- /.gallery-thumbs -->

                </div>
                <!-- /.single-product-gallery -->
            </div>
            <!-- /.gallery-holder -->
            <div class="no-margin col-xs-12 col-sm-7 body-holder">
                <div class="body">
                    <div class="star-holder inline">
                        <div class="star" data-score="4" style="cursor: pointer; width: 80px;">
                            <img src="assets/images/star-on.png" alt="1" title="bad">
                            <img src="assets/images/star-on.png" alt="2" title="poor">
                            <img src="assets/images/star-on.png" alt="3" title="regular">
                            <img src="assets/images/star-on.png" alt="4" title="good">
                            <img src="assets/images/star-off.png" alt="5" title="gorgeous">
                            {{--<input type="hidden" name="score" value="4">--}}
                        </div>
                    </div>
                    {{--<div class="availability">--}}
                        {{--<label>Availability:</label><span class="available">  in stock</span>--}}
                    {{--</div>--}}

                    <div class="title"><a href="#">{{ $product->name }}</a></div>
                    @if ($product->categories->count())
                        <div class="brand">{{
                            $product->categories->reduce(function ($carry, $cate) {
                                if ($carry) {
                                return $carry.', '.$cate->cate_name;
                                } return $carry.$cate->cate_name;
                            })
                        }}</div>
                    @endif
                    {{--<div class="buttons-holder">--}}
                        {{--<a class="btn-add-to-wishlist" href="#">add to wishlist</a>--}}
                        {{--<a class="btn-add-to-compare" href="#">add to compare list</a>--}}
                    {{--</div>--}}

                    <div class="excerpt">
                        <p>{!! $product->message !!}</p>
                    </div>

                    <div class="prices">
                        <div class="price-current">{{ number_format($product->sale_price) }} đ</div>
                        <div class="price-prev">{{ $product->price_formated }}</div>
                    </div>

                    <div class="qnt-holder">
                        <div class="le-quantity">
                            <form>
                                <a class="minus" href="#reduce"></a>
                                <input name="quantity" readonly="readonly" type="text" value="1">
                                <a class="plus" href="#add"></a>
                            </form>
                        </div>
                        <a id="addto-cart" href="{{ route('cart.add', ['id' => $product->id]) }}" class="le-button huge">add to cart</a>
                    </div>
                    <!-- /.qnt-holder -->
                </div>
                <!-- /.body -->

            </div>
            <!-- /.body-holder -->
        </div>
        <!-- /.container -->
    </div>

    <section id="single-product-tab">
        <div class="container">
            <div class="tab-holder">

                <ul class="nav nav-tabs simple">
                    <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                    <li><a href="#additional-info" data-toggle="tab">Additional Information</a></li>
                    {{--<li><a href="#reviews" data-toggle="tab">Reviews (3)</a></li>--}}
                </ul>
                <!-- /.nav-tabs -->

                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <p>{!! $product->message !!}</p>
                        <!-- /.meta-row -->
                    </div>
                    <!-- /.tab-pane #description -->

                    <div class="tab-pane" id="additional-info">
                        <ul class="tabled-data">
                            <li>
                                <label>slug</label>
                                <div class="value">{{ $product->slug ?? 'Not available' }}</div>
                            </li>
                            <li>
                                <label>slug</label>
                                <div class="value">{{ $product->views }}</div>
                            </li>
                            <li>
                                <label>slug</label>
                                <div class="value">{{ $product->sale }}</div>
                            </li>
                            <li>
                                <label>slug</label>
                                <div class="value">{{ $product->quantity }}</div>
                            </li>

                        </ul>
                        <!-- /.tabled-data -->
                        <!-- /.meta-row -->
                    </div>
                    <!-- /.tab-pane #additional-info -->
                    <!-- /.tab-pane #reviews -->
                </div>
                <!-- /.tab-content -->

            </div>
            <!-- /.tab-holder -->
        </div>
        <!-- /.container -->
    </section>
@stop
