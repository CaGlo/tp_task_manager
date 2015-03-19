<?php

require_once '../../application/autoload.php';

use auth\Controller\UsersController;

session_start(); //to ensure you are using same session
session_destroy();
$user = new UsersController();
$user->logout();
header("location: ../index.php"); //to redirect back to "index.php" after logging out
exit();