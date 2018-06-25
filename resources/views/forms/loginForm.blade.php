
<form id=loginForm action="/courses/11" enctype="multipart/form-data" method="GET">
  {{ csrf_field() }}
<label class="control-label" for="courseID">Course ID:</label>
<input type="text" class="form-control" name="courseID" id="courseID">
<input type="submit" value="Submit">
</form>
