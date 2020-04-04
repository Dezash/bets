<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

  $("#search").autocomplete({
    source: function( request, response ) {
      $.ajax({
        url:"{{route('users.search')}}",
        type: 'post',
        dataType: "json",
        data: {
           _token: CSRF_TOKEN,
           search: request.term
        },
        success: function( data ) {
           response( data );
        }
      });
    },
    select: function (event, ui) {
       $('#search').val(ui.item.label);
       $('#searchID').val(ui.item.value);
       return false;
    }
  });

});
</script>