
<form id=eventForm class="form-horizontal" action="/events/{{$eventID}}" enctype="multipart/form-data" method="POST">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
<label class="control-label" for="courseTitle">Title:</label>
<input type="text" class="form-control" name="courseTitle" id="courseTitle" value="{{$courseTitle}}">
<label class="control-label" for="courseDate">Date:</label>
<input type="text" class="form-control" name="courseDate" id="courseDate" value="{{$courseDate}}">
<label class="control-label" for="courseTitle">Length:</label>
<input type="text" class="form-control" name="courseLength" id="courseLength" value="{{$courseLength}}">
<label class="control-label" for="courseTitle">Price:</label>
<input type="text" class="form-control" name="price" id="price" value="{{$price}}">
<label class="control-label" for="courseSummary">Summary:</label>
<textarea class="form-control" rows="5" name="courseSummary" id="courseSummary">
  {{$courseSummary}}
</textarea>
<br>
</form>
