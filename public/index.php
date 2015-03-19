<?php session_start(); 


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
  <?php
  include('menu.php');
  
  $urlEx = explode('/', $_SERVER['PHP_SELF']);
  $urlBase = $urlEx[1];
  ?>
        
        
<?php 
if(!isset($_SESSION['login']))
{
?>        
<div class="container">
    <div class="row">
		<div class="span4 offset4 well">
                <legend>Please Sign In</legend>
          	<div id="error_login" class="alert alert-error hide">
                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
            </div>
                <form id="login" action="Authentification/login.php" method="POST" accept-charset="UTF-8">
			<input type="text" id="username" class="span4" name="username" placeholder="Username">
			<input type="password" id="password" class="span4" name="password" placeholder="Password">
            <label class="checkbox">
            	<input type="checkbox" name="remember" value="1"> Remember Me
            </label>
                        <button id="login_submit" type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>
			</form>    
		</div>
	</div>
</div>
<?php
}elseif(isset($_SESSION['login']))
{
    ?>
<div class="container">
    <div class="row">
		<div class="span4 offset4 well">
                <legend>You're online !</legend>
          	<div id="error_login" class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>Welcome <?php echo $_SESSION['login']; ?>
            </div>
                <form>
			<!--<input type="text" id="username" class="span4" name="username" placeholder=<?php echo $_SESSION['login']; ?>  >-->
			<!--<input type="password" id="password" class="span4" name="password" placeholder="Password">-->
                        <a href='<?php echo '/'.$urlBase; ?>/public/Authentification/logout.php' class="btn btn-danger btn-block" >Se deconnecter</a>
			</form>    
		</div>
	</div>
</div>
<?php } ?>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
                        

            <hr>

            <footer>
                <p>&copy; Company 2012</p>
            </footer>

        </div> <!-- /container -->

    </body>
</html>
