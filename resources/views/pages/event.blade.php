@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Event - {{$eventID}} - {{$startDate}} | Course : {{$courseID}} - {{$courseTitle}}
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <pre>{{$eventJSON}}
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/events/{{$eventID}}/inflate">
      Inflate
    </a>
    <a class="btn btn-primary" href="/events/{{$eventID}}/delegates">
      Delegates
    </a>
    <a class="btn btn-primary" href="/events/{{$eventID}}/cpm">
      CPM
    </a>
    <a class="btn btn-primary" href="/courses/{{$courseID}}/events">
      Cancel
    </a>
  </div>

</div>
@endsection
