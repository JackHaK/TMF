@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Active Contacts :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @foreach ($contacts as $contact)
          <p>Contact ID: {{$contact->id}} - {{$contact->name}} - {{$contact->email}}</p>
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
