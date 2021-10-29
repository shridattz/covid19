$(document).ready(function(){
    

    $("#registerForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "json",
            success: function(data)
            {
                //alert(data); // show response from the php script.
                if(data.success){
                    window.location.href = data.redirect;
                }else{
                    alert("We couldn't identify your credentials");
                }
            }
            });

        
    });



});