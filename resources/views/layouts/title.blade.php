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
      <div class="content">
        <div class="title m-b-md">
            @yield('title')
        </div>
      </div>
    </div>

    <footer class="bottom-left">
        @include('includes.footer')
    </footer>

</div>
</body>
</html>
