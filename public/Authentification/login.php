
<?php

require_once '../../application/autoload.php';

use auth\Controller\UsersController;
 
if(isset($_POST["login"]) && isset($_POST["password"]))
{
   
    $login = $_POST["login"];
    $pass = $_POST["password"];
    $user = new UsersController('',$login,$pass,'','','');
    
    $res = $user->login();
    
    if($res != "FALSE")
    {
        
        session_start();
        $_SESSION['login'] = $user->getLogin();
       
        echo json_encode("OK");
              
    }else
    {       
        echo json_encode("FALSE");
    }
    
}

    
