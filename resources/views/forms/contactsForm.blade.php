
<form id=contactsForm class="form-horizontal" action="/contacts/select" enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
<label class="control-label" for="contactSelect">contacts:</label>
<select style=height:200px multiple class="form-control" name="contactSelect" id="contactSelect">
  @foreach ($contacts as $contact)
    <option value="{{$contact->id}}">{{$contact->id}} - {{$contact->name}} - {{$contact->email}}</option>
  @endforeach
</select>
</form>
