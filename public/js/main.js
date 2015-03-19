$(document).ready(function()
{

    $( "#login" ).submit(function(event) {
        
        event.preventDefault();

        var url = $( "#login" ).attr('action');
        var data = {
                login: $("#username").val(),
                password: $("#password").val()
        };
        var urlHost      = window.location.href;     // Returns full URL
        var urlToRedirect = urlHost.split("index");
       
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
                        var redirectURL = urlToRedirect[0] + "Tache/index.php";
                        document.location.href=""+redirectURL+"";
                    }else if(result == "user")
                    {
                        var redirectURL = urlToRedirect[0] + "user/index.php";
                        document.location.href=""+redirectURL+"";
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





