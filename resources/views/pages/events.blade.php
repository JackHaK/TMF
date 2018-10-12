@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Course : {{$courseID}} | Events :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @include('forms.eventsForm')
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <button class="btn btn-primary" name="select" type="submit" form="eventsForm" value="Submit">
      Select
    </button>
    <button class="btn btn-primary" name="delete" type="submit" form="eventsForm" value="Submit">
      Delete
    </button>
    <a class="btn btn-primary" href="events/inflate">
      Inflate
    </a>
    <a class="btn btn-primary" href="/courses/{{$courseID}}">
      Cancel
    </a>
  </div>

</div>
@endsection
