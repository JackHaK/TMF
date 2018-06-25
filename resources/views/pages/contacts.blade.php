@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Contacts :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @include('forms.contactsForm')
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <button class="btn btn-primary" type="submit" form="contactsForm" name="select" value="select">
      Select
    </button>
    <a class="btn btn-primary" href="contacts/inflate">
      Inflate
    </a>
    <a class="btn btn-primary" href="/">
      Cancel
    </a>
  </div>

</div>
@endsection
