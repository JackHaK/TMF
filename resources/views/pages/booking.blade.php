@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Make Booking on Event: {{$event->id}} - {{$event->course_id}} - {{$event->course->title}} - {{$event->startDate}} :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @include('forms.bookingForm')
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <button class="btn btn-primary" type="submit" form="bookingForm" name="select" value="booking">
      Make Booking
    </button>
    <a class="btn btn-primary" href="/events/{{$event->id}}/delegates">
      Cancel
    </a>
  </div>

</div>
@endsection
