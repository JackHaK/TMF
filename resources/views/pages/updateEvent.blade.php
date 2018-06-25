@extends('layouts.content')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgrey">Edit Event Details</div>
        <div class="panel-body pre-scrollable" style="background-color:lightgrey">
            @include('forms.eventForm')
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgrey">Rendered Event Details</div>
          <div class="panel-body pre-scrollable">
            <table class="table">
              <thead>
                <tr>
                  <th>x</th>
                  <th>y</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Title</td>
                  <td>{!!$courseTitle!!}</td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>{!!$courseDate!!}</td>
                </tr>
                <tr>
                  <td>Length</td>
                  <td>{!!$courseLength!!}</td>
                </tr>
                <tr>
                  <td>Price</td>
                  <td>{!!$price!!}</td>
                </tr>
                <tr>
                  <td>Summary</td>
                  <td>{!!$courseSummary!!}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <button class="btn btn-primary" type="submit" form="eventForm" value="Submit">
        Submit
      </button>
      <a class="btn btn-primary" href="../{{$eventID}}/inflate">
        Re-inflate
      </a>
      <a class="btn btn-primary" href="../{{$eventID}}">
        Cancel
      </a>
    </div>
  </div>

</div>
@endsection
