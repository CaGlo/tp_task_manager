<?php
require_once '../../application/autoload.php';
include '../../application/connexionBdd.php';

use tache\Modele\Tache;
use tache\Controller\TacheController;

$task = new Tache();

$taskList = $bdd->query('SELECT titre,description,echeance,temps_passe,temps_prev,id_tache FROM user_tache ut LEFT JOIN tache t on (ut.id_tache = t.id) WHERE id_user = 6 AND etat =0')->fetchAll();
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

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/chrono.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->


        <div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
                <h1>Liste de vos tâches</h1>
                <?php
                if (empty($taskList)) {
                    echo "<p>Aucune tâche ne vous a été assignée pour le moment</p>";
                } else {

                    echo '<table class="table table-hover">'
                    . '<th>Titre</th>'
                    . '<th>Description</th>'
                    . '<th>Echeance</th>'
                    . '<th>Temps écoulé</th>'
                    . '<th>Temps prévu</th>';

                    foreach ($taskList as $tasks) {
                        $exp_temps = explode(":", $tasks['temps_passe']);
                        echo '<tr class="tache" data-hour=' . $exp_temps[0] . ' data-minute=' . $exp_temps[1] . ' data-seconde=' . $exp_temps[2] . ' data-taskid=' . $tasks['id_tache'] . ' data-titre="' . $tasks['titre'] . '" data-toggle="modal" data-target="#basicModal" data-backdrop="static" >';
                        echo '<td>' . $tasks['titre'] . '</td>';
                        echo '<td>' . $tasks['description'] . '</td>';
                        echo '<td>' . $tasks['echeance'] . '</td>';
                        echo '<td>' . $tasks['temps_passe'] . '</td>';
                        echo '<td>' . $tasks['temps_prev'] . '</td>';
                        echo "</tr>";
                    }
                    echo '</table>';
                }
                ?>
            </div>
            <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Chrono</button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div id="alert" class="alert-block" style="
                                 font-weight: bolder;    
                                 /* margin-bottom: 0.5em; */    text-align: center;
                                 font-size: 3em;
                                 color: blue;
                                 ">
                                <div id="chrono" style="
                                     /* font-weight: bolder; */    
                                     margin-bottom: 0.5em;
                                     /* text-align: center; */
                                     ">
                                    <span id="heure"></span>
                                    <span id="minute"></span>
                                    <span id="seconde"></span>
                                </div>
                                <div>
                                    <a id="play" class="btn btn-large btn-primary"><span class="icon-play"></span></a>
                                    <a id="pause" class="btn btn-large btn-primary"><span class="icon-pause"></span></a>
                                    <a id="stop" class="btn btn-large btn-primary"><span class="icon-stop"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- /container -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="../js/vendor/bootstrap.min.js"></script>

        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
