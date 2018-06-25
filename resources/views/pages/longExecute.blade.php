@extends('layouts.loading', ['script'=>$script])

@section('content')
  <div class="alert alert-info" id="msg">
    <strong>Info!</strong> {{$startMessage}}
  </div>
@endsection
