<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.header')
    @yield('style')
    <title>
        @yield('title', 'EShop')
    </title>
</head>
<body class="">
    <div class="wrapper ">
        @include('backend.layouts.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
            @include('backend.layouts.navbar')
            <!-- End Navbar -->

            @yield('content')
            @include('backend.layouts.footer')
        </div>
    </div>
@yield('script')
</body>
</html>
