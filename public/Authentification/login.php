
<?php

require_once '../../application/autoload.php';

use auth\Controller\UsersController;

if(isset($_POST["login"]) && isset($_POST["password"]))
{
    
    $login = $_POST["login"];
    $pass = $_POST["password"];
   
    $user = new UsersController('',$login,$pass,'','','');
    
    if($user->login() != false)
    {
        
        session_start();
        $_SESSION['id_user'] = $user->getId();
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['role'] = $user->getRole();

       
        echo json_encode("OK");
              
    }else
    {       
        echo json_encode("FALSE");

        
        

    }
    
}

    
