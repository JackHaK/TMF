
<form id=delegatesForm class="form-horizontal" action="/delegates/select" enctype="multipart/form-data" method="GET">
  {{ csrf_field() }}
<label class="control-label" for="delegateSelect">Delegates:</label>
<select style=height:200px multiple class="form-control" name="delegateSelect" id="delegateSelect">
  @foreach ($delegates as $delegate)
    <option value="{{$delegate->id}}">{{$delegate->id}} - {{$delegate->name}} - {{$delegate->email}}</option>
  @endforeach
</select>
<label class="control-label" for="Contact:">Categories:</label>
<input type="text" class="form-control" name="bookingContact" id="bookingContact" value=""><br>
</form>
