<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder hover">

            <div class="title-nav">
                <h2 class="h1">Recently Viewed</h2>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->

            <div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                @foreach ($products as $product)
                    <div class="no-margin carousel-item product-item-holder size-small hover">
                        <div class="product-item">
                            <div class="ribbon red"><span>sale</span></div>
                            <div class="image">
                                <img alt="" src="{{ asset('assets/images/blank.gif') }}" data-echo="{{ asset('assets/images/products/product-11.jpg') }}" />
                            </div>
                            <div class="body">
                                <div class="title">
                                    <a href="single-product.html">{{ $product->name }}</a>
                                </div>
                                <div class="brand">{{ $product->categories->first() ? $product->categories->first() : '' }}</div>
                            </div>
                            <div class="prices">
                                <div class="price-current text-right">{{ $product->price_formated }}</div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="single-product.html" class="le-button">Add to Cart</a>
                                </div>
                                {{--<div class="wish-compare">--}}
                                    {{--<a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>--}}
                                    {{--<a class="btn-add-to-compare" href="#">Compare</a>--}}
                                {{--</div>--}}
                            </div>
                        </div><!-- /.product-item -->
                    </div><!-- /.product-item-holder -->
                @endforeach

            </div><!-- /#recently-carousel -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->
