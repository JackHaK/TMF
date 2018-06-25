<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$.ajax({
               type:'GET',
               url:'/events/inflateAll',
               timeout:0,
               success:function(data, textStatus){
                  alert('Events Inflate Complete');
                },
               error:function(jqXHR, textStatus, errorThrown){
                     alert('Events Inflate failed - ' + textStatus + ' ' + errorThrown);
                },
               complete:function() {
                 $('div.half-circle-spinner').fadeOut(100);
                 $("#msg").html('<strong>Info!</strong> ' + 'Events Inflate Complete')
               }
            });
</script>
