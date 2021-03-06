@extends('frontend.layouts.default')
@section('content')
    <section id="category-grid">
        <div class="container">
            <!-- ========================================= SIDEBAR ========================================= -->
            <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
                <!-- ========================================= PRODUCT FILTER ========================================= -->
                <div class="widget">
                    <h1>Product Filters</h1>
                    <div class="body bordered">

                        <div class="category-filter">
                            <h2>Categories</h2>
                            <hr>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <input class="le-checkbox switch-category" type="checkbox" {{ request('cate') == $category->id ? 'checked' : '' }} data-id="{{ $category->id }}"/>
                                        <label>{{ $category->cate_name }}</label>
                                        <span class="pull-right">({{ $category->products->count() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- /.category-filter -->

                        {{--<div class="price-filter">--}}
                            {{--<h2>Price</h2>--}}
                            {{--<hr>--}}
                            {{--<div class="price-range-holder">--}}

                                {{--<input type="text" class="price-slider" value="" >--}}

                                {{--<span class="min-max">--}}
                                    {{--Price: $89 - $2899--}}
                                {{--</span>--}}
                                {{--<span class="filter-button">--}}
                                    {{--<a href="#">Filter</a>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</div><!-- /.price-filter -->--}}

                    </div><!-- /.body -->
                </div><!-- /.widget -->
                <!-- ========================================= PRODUCT FILTER : END ========================================= -->

            </div>
            <!-- ========================================= SIDEBAR : END ========================================= -->

            <!-- ========================================= CONTENT ========================================= -->
            <div class="col-xs-12 col-sm-9 no-margin wide sidebar">
                <section id="gaming">
                    <div class="grid-list-products">
                        <h2 class="section-title">{{ request('cate') ? 'By category': 'All categories' }}</h2>

                        <div class="control-bar">
                            {{--<div id="popularity-sort" class="le-select" >--}}
                                {{--<select data-placeholder="sort by popularity">--}}
                                    {{--<option value="1">1-100 players</option>--}}
                                    {{--<option value="2">101-200 players</option>--}}
                                    {{--<option value="3">200+ players</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            <div id="item-count" class="le-select">
                                <select>
                                    <option value="1">24 per page</option>
                                    <option value="2">48 per page</option>
                                    <option value="3">32 per page</option>
                                </select>
                            </div>

                            <div class="grid-list-buttons">
                                <ul>
                                    <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> Grid</a></li>
                                    <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> List</a></li>
                                </ul>
                            </div>
                        </div><!-- /.control-bar -->

                        <div class="tab-content">
                            <div id="grid-view" class="products-grid fade tab-pane in active">

                                <div class="product-grid-holder">
                                    <div class="row no-margin">
                                        @foreach ($products as $product)
                                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                                <div class="product-item">
                                                    <div class="ribbon red"><span>sale</span></div>
                                                    <div class="image">
                                                        <img alt="" src="{{ asset('assets/images/blank.gif') }}" data-echo="{{ 'images/'.$product->image }}" />
                                                    </div>
                                                    <div class="body">
                                                        <div class="label-discount green">-50% sale</div>
                                                        <div class="title">
                                                            <a href="{{ route('product.index', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                        </div>
                                                        {{--<div class="brand">sony</div>--}}
                                                    </div>
                                                    <div class="prices">
                                                        {{--<div class="price-prev">{{ $product->price_formated }}</div>--}}
                                                        <div class="price-current pull-right">{{ $product->price_formated }}</div>
                                                    </div>
                                                    <div class="hover-area">
                                                        <div class="add-cart-button">
                                                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="le-button">add to cart</a>
                                                        </div>
                                                        {{--<div class="wish-compare">--}}
                                                            {{--<a class="btn-add-to-wishlist" href="#">add to wishlist</a>--}}
                                                            {{--<a class="btn-add-to-compare" href="#">compare</a>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                </div><!-- /.product-item -->
                                            </div><!-- /.product-item-holder -->
                                        @endforeach
                                    </div><!-- /.row -->
                                </div><!-- /.product-grid-holder -->

                                {{ $products->links('frontend.layouts.pagination') }}
                            </div><!-- /.products-grid #grid-view -->

                            <div id="list-view" class="products-grid fade tab-pane ">
                                <div class="products-list">
                                    @foreach ($products as $product)
                                        <div class="product-item product-item-holder">
                                            <div class="ribbon red"><span>sale</span></div>
                                            <div class="ribbon blue"><span>new!</span></div>
                                            <div class="row">
                                                <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                                    <div class="image">
                                                        <img alt="" src="{{ asset('assets/images/blank.gif') }}" data-echo="{{ 'images/'.$product->image }}" />
                                                    </div>
                                                </div><!-- /.image-holder -->
                                                <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                                    <div class="body">
                                                        <div class="label-discount green">-50% sale</div>
                                                        <div class="title">
                                                            <a href="{{ route('product.index', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                        </div>
                                                        <div class="brand">sony</div>
                                                        <div class="excerpt">
                                                            <p>{{ $product->message }}</p>
                                                        </div>
                                                        {{--<div class="addto-compare">--}}
                                                            {{--<a class="btn-add-to-compare" href="#">add to compare list</a>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                </div><!-- /.body-holder -->
                                                <div class="no-margin col-xs-12 col-sm-3 price-area">
                                                    <div class="right-clmn">
                                                        <div class="price-current">{{ $product->price_formated }}</div>
                                                        {{--<div class="price-prev">$1399.00</div>--}}
                                                        <div class="availability"><label>availability:</label><span class="available">  in stock</span></div>
                                                        <a class="le-button" href="{{ route('cart.add', ['id' => $product->id]) }}">add to cart</a>
                                                        {{--<a class="btn-add-to-wishlist" href="#">add to wishlist</a>--}}
                                                    </div>
                                                </div><!-- /.price-area -->
                                            </div><!-- /.row -->
                                        </div><!-- /.product-item -->
                                    @endforeach

                                </div><!-- /.products-list -->

                                {{ $products->links('frontend.layouts.pagination') }}

                            </div><!-- /.products-grid #list-view -->

                        </div><!-- /.tab-content -->
                    </div><!-- /.grid-list-products -->

                </section><!-- /#gaming -->
            </div><!-- /.col -->
            <!-- ========================================= CONTENT : END ========================================= -->
        </div><!-- /.container -->
    </section><!-- /#category-grid -->
@stop
@section('script')
    <script>
        $('.switch-category').change((e) => {
            const id = $(e.target).attr('data-id');
            window.location = '{{ route('shop') }}?cate='+id;
        })
    </script>
@stop
