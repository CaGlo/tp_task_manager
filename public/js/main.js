$(document).ready(function()
{
    
    $( "#login" ).submit(function(event) {
        
        event.preventDefault();

        var url = "login.php";
        var data = {
                login: $("#username").val(),
                password: $("#password").val()
        };
console.log(data);
    $.ajax({
            url: url,
            data: data,
            type: 'POST',
            success: function(response){
               
                var result = jQuery.parseJSON(response);
                if(result == "OK")
                {
                    $("#error_login").removeClass("");
                    $("#error_login").addClass("alert-success");
                    $("#error_login").html("Authentification Réussi !");
                    document.location.href="index.php";
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





