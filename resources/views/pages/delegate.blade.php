@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Delegate - {{$delegateID}} - {{$delegateName}} - {{$delegateEmail}}
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <pre>{{$delegateJSON}}
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/events/{{$eventID}}/delegates">
      Cancel
    </a>
  </div>

</div>
@endsection
