<!-- ========================================= BEST SELLERS ========================================= -->
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">Danh sách sản phẩm</h1>

        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-7 no-margin">

                <div class="row no-margin">
                    @foreach ($products as $product)
                        <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                            <div class="product-item">
                                <div class="image">
                                    <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-05.jpg" />
                                </div>
                                <div class="body">
                                    <div class="label-discount clear"></div>
                                    <div class="title">
                                        <a href="single-product.html">{{ $product->name }}</a>
                                    </div>
                                    <div class="brand">beats</div>
                                </div>
                                <div class="prices">

                                    <div class="price-current text-right">{{ $product->price_formated }}</div>
                                </div>
                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="single-product.html" class="le-button">Add to cart</a>
                                    </div>
                                    <div class="wish-compare">
                                        <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                        <a class="btn-add-to-compare" href="#">Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.product-item-holder -->
                    @endforeach

                </div><!-- /.row -->

            </div><!-- /.col -->
            <div class="col-xs-12 col-md-5 no-margin">
                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="best-seller-single-product-slider" class="single-product-slider owl-carousel">
                        <div class="single-product-gallery-item" id="slide1">
                            <a data-rel="prettyphoto" href="assets/images/products/product-gallery-01.jpg">
                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-gallery-01.jpg" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->

                        <div class="single-product-gallery-item" id="slide2">
                            <a data-rel="prettyphoto" href="assets/images/products/product-gallery-01.jpg">
                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-gallery-01.jpg" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->

                        <div class="single-product-gallery-item" id="slide3">
                            <a data-rel="prettyphoto" href="assets/images/products/product-gallery-01.jpg">
                                <img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/product-gallery-01.jpg" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->
                    </div><!-- /.single-product-slider -->

                    <div class="gallery-thumbs clearfix">
                        <ul>
                            <li><a class="horizontal-thumb active" data-target="#best-seller-single-product-slider" data-slide="0" href="#slide1"><img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/gallery-thumb-01.jpg" /></a></li>
                            <li><a class="horizontal-thumb" data-target="#best-seller-single-product-slider" data-slide="1" href="#slide2"><img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/gallery-thumb-01.jpg" /></a></li>
                            <li><a class="horizontal-thumb" data-target="#best-seller-single-product-slider" data-slide="2" href="#slide3"><img alt="" src="assets/images/blank.gif" data-echo="assets/images/products/gallery-thumb-01.jpg" /></a></li>
                        </ul>
                    </div><!-- /.gallery-thumbs -->

                    <div class="body">
                        <div class="label-discount clear"></div>
                        <div class="title">
                            <a href="single-product.html">CPU intel core i5-4670k 3.4GHz BOX B82-12-122-41</a>
                        </div>
                        <div class="brand">sony</div>
                    </div>
                    <div class="prices text-right">
                        <div class="price-current inline">$1199.00</div>
                        <a href="cart.html" class="le-button big inline">add to cart</a>
                    </div>
                </div><!-- /.product-item-holder -->
            </div><!-- /.col -->

        </div><!-- /.product-grid-holder -->
    </div><!-- /.container -->
</section><!-- /#bestsellers -->
<!-- ========================================= BEST SELLERS : END ========================================= -->
