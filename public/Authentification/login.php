
<?php

require_once '../../application/autoload.php';

use auth\Modele\UsersController;

if(isset($_POST["Login"]) && isset($_POST["Password"]))
{
    
    $login = $_POST["Login"];
    $pass = $_POST["Password"];
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

        header("Location: index.php");

    }
    
}

    
