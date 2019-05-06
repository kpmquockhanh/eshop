<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
</head>

<body>
<div class="wrapper">
    @include('frontend.layouts.nav')

    @include('frontend.layouts.header')

    @yield('content')


    {{--    @include('frontend.layouts.product-tab')--}}
    {{--    @include('frontend.layouts.best-seller', ['products' => $products])--}}

{{--    @include('frontend.layouts.recently-viewed', ['products' => $products])--}}

    {{--    @include('frontend.layouts.brands')--}}
    @include('frontend.layouts.footer')
</div><!-- /.wrapper -->

@include('frontend.layouts.script')
@yield('script')
</body>
</html>
