<!-- ============================================================= TOP NAVIGATION ============================================================= -->
<nav class="top-bar animate-dropdown">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
                <li><a href="/">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle"  data-toggle="dropdown" href="#change-colors">Change Colors</a>

                    <ul class="dropdown-menu" role="menu" >
                        <li role="presentation"><a role="menuitem" class="changecolor green-text" tabindex="-1" href="#" title="Green color">Green</a></li>
                        <li role="presentation"><a role="menuitem" class="changecolor blue-text" tabindex="-1" href="#" title="Blue color">Blue</a></li>
                        <li role="presentation"><a role="menuitem" class="changecolor red-text" tabindex="-1" href="#" title="Red color">Red</a></li>
                        <li role="presentation"><a role="menuitem" class="changecolor orange-text" tabindex="-1" href="#" title="Orange color">Orange</a></li>
                        <li role="presentation"><a role="menuitem" class="changecolor navy-text" tabindex="-1" href="#" title="Navy color">Navy</a></li>
                        <li role="presentation"><a role="menuitem" class="changecolor dark-green-text" tabindex="-1" href="#" title="Darkgreen color">Dark Green</a></li>
                    </ul>
                </li>
                {{--<li><a href="blog.html">Blog</a></li>--}}
                {{--<li><a href="faq.html">FAQ</a></li>--}}
                {{--<li><a href="contact.html">Contact</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#pages">Pages</a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li><a href="index.html">Home</a></li>--}}
                        {{--<li><a href="index-2.html">Home Alt</a></li>--}}
                        {{--<li><a href="category-grid.html">Category - Grid/List</a></li>--}}
                        {{--<li><a href="category-grid-2.html">Category 2 - Grid/List</a></li>--}}
                        {{--<li><a href="single-product.html">Single Product</a></li>--}}
                        {{--<li><a href="single-product-sidebar.html">Single Product with Sidebar</a></li>--}}
                        {{--<li><a href="cart.html">Shopping Cart</a></li>--}}
                        {{--<li><a href="checkout.html">Checkout</a></li>--}}
                        {{--<li><a href="about.html">About Us</a></li>--}}
                        {{--<li><a href="contact.html">Contact Us</a></li>--}}
                        {{--<li><a href="blog.html">Blog</a></li>--}}
                        {{--<li><a href="blog-fullwidth.html">Blog Full Width</a></li>--}}
                        {{--<li><a href="blog-post.html">Blog Post</a></li>--}}
                        {{--<li><a href="faq.html">FAQ</a></li>--}}
                        {{--<li><a href="terms.html">Terms & Conditions</a></li>--}}
                        {{--<li><a href="authentication.html">Login/Register</a></li>--}}
                        {{--<li><a href="404.html">404</a></li>--}}
                        {{--<li><a href="wishlist.html">Wishlist</a></li>--}}
                        {{--<li><a href="compare.html">Product Comparison</a></li>--}}
                        {{--<li><a href="track-your-order.html">Track your Order</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
                @if (!\Illuminate\Support\Facades\Auth::guard('user')->check())
                    <li><a href="{{ route('login') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li><a href="#">Hello {{ \Illuminate\Support\Facades\Auth::guard('user')->user()->name }}, Welcome back!</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
<!-- ============================================================= TOP NAVIGATION : END ============================================================= -->
