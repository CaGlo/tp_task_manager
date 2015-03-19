<?php session_start();

if(!isset($_SESSION))
{
    header('location: ../index.php');
}elseif(isset($_SESSION['role']) && $_SESSION['role'] != "CDP")
{    
    header('location: ../index.php');
}

require_once '../../application/autoload.php';

use auth\Controller\UsersController;

$user = new UsersController();

$list_users = $user->listUsers();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Gestion de Tâches</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">


        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
        
        <link rel="stylesheet" href="../css/main.css">
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/vendor/bootstrap.js"></script>

        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/tache.js"></script>
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <?php
  include("../menu.php");
 ?>

        <div class="container">
            

            <form id="createTask" name="createTask" method="POST" action="createTask.php" class="form-horizontal">
            <fieldset>

            <!-- Form Name -->
            <legend>Creation d'une tâche</legend>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="titre"></label>
              <div class="controls">
                <input id="titre" name="titre" type="text" placeholder="Titre" class="input-medium">

              </div>
            </div>

            <!-- Textarea -->
            <div class="control-group">
              <label class="control-label" for="description"></label>
              <div class="controls">                     
                <textarea id="description" name="description">Description</textarea>
              </div>
            </div>
 
            <!-- Select Multiple -->
           <div class="control-group">
                <label class="control-label" for="selectmultiple">Select Multiple</label>
                <div class="controls">
                  <select id="usermultiple" name="usermultiple[]" class="input-medium" multiple="multiple">
                      <?php 
                         
                   foreach($list_users as $user)
                   {
                      
                       echo "<option value='".$user['id']."'>".ucfirst($user['nom'])." ".ucfirst($user['prenom'])."</option>";

                   }

                    ?>
                  </select>
                </div>
           </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="echeance">Echéance</label>
              <div class="controls">
                <input id="echeance" name="echeance" type="text" placeholder="jj-mm-aaaa" class="input-medium">

              </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="temps_prev">Temps estimé</label>
              <div class="controls">
                <input id="temps_prev" name="temps_prev" type="text" placeholder="hh:mm:ss" class="input-medium">

              </div>
            </div>

            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="submit_create_task"></label>
              <div class="controls">
                <button id="submit_create_task" name="submit_create_task" class="btn btn-success">Sauvegarder</button>
              </div>
            </div>

            </fieldset>
            </form>

                        

            <hr>

            <footer>
                <p>&copy; Company 2012</p>
            </footer>

        </div> <!-- /container -->

      
    </body>
</html>
