@extends('layouts.content')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgrey">Edit Course Details</div>
        <div class="panel-body pre-scrollable" style="background-color:lightgrey">
            @include('forms.courseForm')
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgrey">Rendered Course Details</div>
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
                  <td>Page</td>
                  <td>{!!$coursePage!!}</td>
                </tr>
                <tr>
                  <td>Categories</td>
                  <td>{!!$courseCategories!!}</td>
                </tr>
                <tr>
                  <td>Summary</td>
                  <td>{!!$courseSummary!!}</td>
                </tr>
                <tr>
                  <td>Topics</td>
                  <td>{!!$courseTopics!!}</td>
                </tr>
                <tr>
                  <td>Method</td>
                  <td>{!!$courseMethod!!}</td>
                </tr>
                <tr>
                  <td>Benefits</td>
                  <td>{!!$courseBenefits!!}</td>
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
      <button class="btn btn-primary" type="submit" form="courseForm" value="Submit">
        Submit
      </button>
      <a class="btn btn-primary" href="../{{$courseID}}/inflate">
        Re-inflate
      </a>
      <a class="btn btn-primary" href="../{{$courseID}}">
        Cancel
      </a>
    </div>
  </div>

</div>
@endsection
