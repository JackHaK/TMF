@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Course {{$courseID}} - {{$courseTitle}} - {!!$courseLength!!} - £{{$coursePrice}}
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <pre>{{$courseJSON}}
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/courses/{{$courseID}}/edit">
      Update
    </a>
    <a class="btn btn-primary" href="/courses/{{$courseID}}/events">
      Events
    </a>
    <a class="btn btn-primary" href="/courses/{{$courseID}}/attachments">
      Attachments
    </a>
    <a class="btn btn-primary" href="/courses">
      Cancel
    </a>
  </div>

</div>
@endsection
