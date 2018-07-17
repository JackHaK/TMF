@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Course {{$courseID}} -
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        @include('forms.attachmentsForm')
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
<<<<<<< HEAD
    <button class="btn btn-primary" type="submit" form="attachmentsForm" value="Submit">
      Upload
    </button>
    <a class="btn btn-primary" href="/">
      Delete
    </a>
=======
    <button class="btn btn-primary" name="upload" type="submit" form="attachmentsForm" value="Submit">
      Upload
    </button>
    <button class="btn btn-primary" name="delete" type="submit" form="attachmentsForm" value="Submit">
      Delete
  </button>
>>>>>>> JacksBranch
    <a class="btn btn-primary" href="/courses/{{$courseID}}">
      Cancel
    </a>
  </div>

</div>
@endsection
