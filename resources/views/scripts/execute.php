<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$.ajax({
               type:'GET',
               url:"{{$route}}",
               success:function(data, textStatus){
                  alert("{{$endMessage}}");
                },
               error:function(jqXHR, textStatus, errorThrown){
                     alert('Execute failed - ' + textStatus + ' ' + errorThrown);
                },
               complete:function() {
                 $('div.alert').fadeOut(100);
                 $('div.half-circle-spinner').fadeOut(100);
               }
            });
</script>
