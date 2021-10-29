// window.addEventListener('load', (event) => {
//     alert('page is fully loaded');
//   });
//   window.addEventListener('DOMContentLoaded', (event) => {
//     alert('dom is fully loaded');
//   });
$(document).ready(function(){
    

    $("#loginForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        var data1 = {
            "email" : $("#email").val(),
            "password" : $("#password").val()
        }
        
        $.ajax({
            type: "POST",
            url: url,
            data: data1,//form.serialize(), // serializes the form's elements.
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