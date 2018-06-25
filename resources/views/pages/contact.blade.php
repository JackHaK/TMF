@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Contact - {{$contactID}} - {{$contactName}} - {{$contactEmail}}
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <pre>{{$contactJSON}}
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/contacts">
      Cancel
    </a>
  </div>

</div>
@endsection
