<?php

try {

require_once '../../application/autoload.php';

$bdd = new \PDO('mysql:host=localhost;dbname=tp_gestion_tache;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['user']) && isset($_POST['tache']) && isset($_POST['temps'])) {
    $user = $_POST['user'];
    $time = $_POST['temps'];
    $tache = $_POST['tache'];
    $query = 'UPDATE user_tache SET temps_passe =\''
            . $time . '\' WHERE id =' . $user . ' AND id_tache =' . $tache;
    $bdd->exec($query);
    echo $query;
}
if (isset($_POST['etat']) && isset($_POST['tache'])){
    echo 'salutation';
    $etat = $_POST['etat'];
    $tache = $_POST['tache'];
    $query = 'UPDATE tache SET etat ='. $etat . ' WHERE id =' . $tache;
    $bdd->exec($query);
}

