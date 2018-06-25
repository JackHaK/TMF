@extends('layouts.content')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          @if ($viewLocal)
            Local Version -
          @else
            Administrate Version -
          @endif
        </strong>
        Course {{$courseID}} - {{$courseTitle}} - {!!$courseLength!!} - £{{$coursePrice}}
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <pre>{{$courseJSON}}
      </div>
    </div>
    <div class="alert alert-info">
      @if ($useLocal)
        <strong>Info!</strong> Using Local Version
      @else
        <strong>Info!</strong> Using Administrate Version
      @endif
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    @if ($viewLocal)
      <a class="btn btn-primary" href="/courses/{{$courseID}}/administrate">
        Administrate Version
      </a>
    @else
      <a class="btn btn-primary" href="/courses/{{$courseID}}/local">
        Local Version
      </a>
    @endif
    <a class="btn btn-primary" href="/courses/{{$courseID}}/edit">
      Update
    </a>
    <a class="btn btn-primary" href="/courses/{{$courseID}}/events">
      Events
    </a>
    <a class="btn btn-primary" href="/courses">
      Cancel
    </a>
  </div>

</div>
@endsection
