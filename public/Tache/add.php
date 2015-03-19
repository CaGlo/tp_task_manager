<?php session_start(); 



if(!isset($_SESSION['login']))
{
     header('Location: ../Authentification/index.php');
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

        <link rel="stylesheet" href="../css/bootstrap.min_1.css">
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
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Project name</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                       
                        <?php
                        
                        if(isset($_SESSION['login']))
                        {
                        ?>
                        <div class="navbar-form pull-right">
                            <span class="span2"><?php echo "Hello ". $_SESSION['login']." "; ?> </span>
                            <span class="span2"><a href="logout.php">Se deconnecter</a></span>
                        </div>
                        
                        <?php } ?>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

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
