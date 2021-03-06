
<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
</head>

<body>
<div class="wrapper">
    @include('frontend.layouts.nav')

    @include('frontend.layouts.header')

    @include('frontend.layouts.carousel')
    

{{--    @include('frontend.layouts.product-tab')--}}
{{--    @include('frontend.layouts.best-seller', ['products' => $products])--}}

{{--    @include('frontend.layouts.recently-viewed', ['products' => $products])--}}
    @include('frontend.layouts.recently-viewed', ['products' => $products])
    @foreach($categories as $category)
        @include('frontend.layouts.category', ['products' => $category->products, 'title' => $category->cate_name])
    @endforeach

{{--    @include('frontend.layouts.brands')--}}
    @include('frontend.layouts.footer')
</div><!-- /.wrapper -->

@include('frontend.layouts.script')
</body>
</html>
