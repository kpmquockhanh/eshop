<!doctype html>
<html lang="en">
<head>
    @include('backend.layouts.header')
   <title>
       @yield('title', 'Admin area')
   </title>
</head>
<body class="@yield('class-body')" style="height: 100vh;">
    @include('backend.layouts.navbar_page')
    @yield('content')
    @yield('script')
</body>
</html>