<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="flex-center position-ref full-height">

    <header class="row">
        @include('includes.header')
    </header>

    <div class="row">
      @include('flash::message')
      @yield('content')
    </div>

    <footer class="bottom-left">
        @include('includes.footer')
    </footer>

</div>
@include('scripts.fade')
</body>
</html>
