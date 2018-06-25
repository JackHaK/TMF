@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Active Courses :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @foreach ($courses as $course)
          <p>Course ID: {{$course->id}} - {{$course->title}} - £{{$course->price}}</p>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/">
      Cancel
    </a>
  </div>

</div>
@endsection
