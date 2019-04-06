
<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.header')
</head>

<body class="">

<div class="wrapper ">
    @include('backend.layouts.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
        @include('backend.layouts.navbar')
        <!-- End Navbar -->

        @yield('content')
  </div> -->
    </div>
</div>
@include('backend.layouts.footer')
</body>

</html>