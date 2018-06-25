
<form id=courseForm class="form-horizontal" action="/courses/{{$courseID}}" enctype="multipart/form-data" method="POST">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
<label class="control-label" for="courseTitle">Title:</label>
<input type="text" class="form-control" name="courseTitle" id="courseTitle" value="{{$courseTitle}}">
<label class="control-label" for="coursePage">Page:</label>
<input type="text" class="form-control" name="coursePage" id="coursePage" value="{{$coursePage}}">
<label class="control-label" for="courseCategories">Categories:</label>
<input type="text" class="form-control" name="courseCategories" id="courseCategories" value="{{$courseCategories}}">
<label class="control-label" for="courseSummary">Summary:</label>
<textarea class="form-control" rows="5" name="courseSummary" id="courseSummary">
  {{$courseSummary}}
</textarea>
<label class="control-label" for="courseTopics">Topics:</label>
<textarea class="form-control" rows="5" name="courseTopics" id="courseTopics">
  {{$courseTopics}}
</textarea>
<label class="control-label" for="courseMethod">Method:</label>
<textarea class="form-control" rows="5" name="courseMethod" id="courseMethod">
  {{$courseMethod}}
</textarea>
<label class="control-label" for="courseBenefits">Benefits:</label>
<textarea class="form-control" rows="5" name="courseBenefits" id="courseBenefits">
  {{$courseBenefits}}
</textarea>
<br>
</form>
