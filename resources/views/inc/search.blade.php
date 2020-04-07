<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
    $('.search').each(function(i, el) {
        el = $(el);
        el.autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: el.attr('data-route'),
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                      console.log(xhr.status);
                      console.log(xhr.responseText);
                      console.log(thrownError);
                    }
                });
            },
            select: function(event, ui) {
                el.val(ui.item.label);
                $('#' + el.attr('data-updatefield')).val(ui.item.value);
                return false;
            }
        });
    });
});
</script>