<?php session_start(); 
 var_dump($_SESSION);
require_once '../application/autoload.php';

use auth\Modele\UsersController;

$userC = new UsersController('',$_SESSION['login'],'12345678','','','','');

$res = $userC->login();
