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

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          @yield('content')
        </div>
      </div>
      <div class="row text-center top-three">
        <div class="col-md-2 col-md-offset-5">
          <div class="half-circle-spinner">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
          </div>
        </div>
      </div>
    </div>

    <footer class="bottom-left">
        @include('includes.footer')
    </footer>

</div>
@include($script)
</body>
</html>
