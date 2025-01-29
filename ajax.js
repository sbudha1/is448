$(document).ready(function() {
    $('#feedback-form').submit(function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize(); 

        $('#feedback-message').html('Loading...').css({
            'display': 'block',
            'text-align': 'center'
        });

       
        $.ajax({
            type: 'POST',
            url: 'submit_response.php',
            data: formData,
            success: function(response) {
               
                $('#feedback-message').html(response);
            },
            error: function(xhr, status, error) {
            
                $('#feedback-message').html('Error: ' + error);
            }
        });
    });
});
