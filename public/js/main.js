$(document).ready(function()
{

    $( "#login" ).submit(function(event) {
        
        event.preventDefault();

        var url = $( "#login" ).attr('action');
        var data = {
                login: $("#username").val(),
                password: $("#password").val()
        };
        console.log(data);
        console.log(url);
    $.ajax({
            url: url,
            data: data,
            type: 'POST',
            success: function(response){
               console.log(response);
                var result = jQuery.parseJSON(response);
                console.log(result);
                if(result != "FALSE")
                {
                    $("#error_login").removeClass("");
                    $("#error_login").addClass("alert-success");
                    $("#error_login").html("Authentification Réussi !");
                    
                    if(result == "CDP")
                    {
                        document.location.href="http://localhost/tp_task_manager/public/Tache/index.php";
                    }else if(result == "user")
                    {
                        document.location.href="http://localhost/tp_task_manager/public/user/index.php";
                    }
                    
                }else if(result == "FALSE")
                {
                     $("#error_login").show();
                }
            },
                error : function()
                {
                    $("#error_login").show();
                    $("#error_login").html("");
                    $("#error_login").html("erreur AJAX");
                }
    });
    });
});





