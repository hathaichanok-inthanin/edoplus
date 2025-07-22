<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edo Plus+ | With You in Every Lifestyle</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    @include('/frontend/layouts/css')
</head>

<body class="index-page">
    @include('frontend/layouts/navbar')
    <main class="main">
        @yield('content')
    </main>
    @include('frontend/layouts/footer')
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}
    @include('frontend/layouts/js')
</body>

</html>
