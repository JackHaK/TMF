
<form id=eventsForm class="form-horizontal" action="/events/select" enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
<label class="control-label" for="eventSelect">Events:</label>
<select style=height:200px multiple class="form-control" name="eventSelect" id="eventSelect">
  @foreach ($events as $event)
    <option value="{{$event->id}}">Event ID: {{$event->id}} - Course ID: {{$event->course_id}} - {{$event->courseTitle}} - {{$event->startDate}} - £{{$event->price}}</option>
  @endforeach
</select>
<br>
</form>
