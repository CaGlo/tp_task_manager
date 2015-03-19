<?php
//require_once '../../application/autoload.php';
//include '../../application/connexionBdd.php';
require_once '../template/header.php';

use tache\Modele\Tache;
use tache\Controller\TacheController;
use auth\Modele\Users;

$user = new Users();
$user->findById(7);
$user->setArrayTacheDB();
$taskList = $user->getArrayTache();


?>

        <div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
                <h1>Liste de vos tâches</h1>
                <?php
                if (!$taskList['tache']) {
                    echo "<p>Aucune tâche ne vous a été assignée pour le moment</p>";
                } else {

                    echo '<table class="table table-hover">'
                    . '<th>Titre</th>'
                    . '<th>Description</th>'
                    . '<th>Echeance</th>'
                    . '<th>Temps écoulé</th>'
                    . '<th>Temps prévu</th>';

                    foreach ($taskList['tache'] as $tasks) {
                        //var_dump($tasks->id);
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
    <?php  require_once '../template/footer.php';?>
    </body>
</html>
