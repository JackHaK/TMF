
<form id=attachmentsForm class="form-horizontal" action="attachments/action" enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
<label class="control-label" for="attachmentSelect">attachments:</label>
<select style=height:200px multiple class="form-control" name="attachmentSelect" id="attachmentSelect">
  @foreach ($attachments as $attachment)
    <option value="{{$attachment}}">{{$attachment}}</option>
  @endforeach
</select>
<label class="control-label" for="attachmentFile">Upload File:</label>
<input type="file" name="attachmentFile" id="attachmentFile">
</form>
