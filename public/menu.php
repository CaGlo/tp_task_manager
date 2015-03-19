
  
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Task Manager</a>
                    <?php
                   $urlEx = explode('/', $_SERVER['PHP_SELF']);
                   $urlBase = $urlEx[1];
                  
   if(isset($_SESSION['role']) && $_SESSION['role'] == "CDP")
   {
       
   ?>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href='<?php echo '/'.$urlBase; ?>/public/Tache/add.php'>Creation tâche</a></li>
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
                       
                      
                        <div class="navbar-form pull-right">
                            <span class="span2"><?php echo "Hello ". $_SESSION['login']." "; ?> </span>
                            <span class="span2"><a href='<?php echo '/'.$urlBase; ?>/public/Authentification/logout.php'>Se deconnecter</a></span>
                        </div>
                        
                        
                    </div><!--/.nav-collapse -->
                    <?php } else { ?>
                        <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="index.php">Se connecter</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                    
                    <?php } ?>
                </div>
            </div>
        </div>
