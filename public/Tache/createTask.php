<?php

session_start();

if(!isset($_SESSION))
{
    header('location: ../index.php');
}elseif(isset($_SESSION['role']) && $_SESSION['role'] != "CDP")
{
    header('location: ../index.php');
}
        

require_once '../../application/autoload.php';

use tache\Controller\TacheController;
 
if(isset($_POST))
{
    
    
    $arrayPost = array();
    $arrayPost['titre'] = $_POST['titre'];
    $arrayPost['description'] = $_POST['description'];
    $arrayPost['user'] = $_POST['usermultiple'];
    $arrayPost['echeance'] = $_POST['echeance'];
    $arrayPost['temps_prev'] = $_POST['temps_prev'];
    
    $tacheC = new TacheController($arrayPost);
    $tacheC->addTache();
    header("location: add.php");
    
}
