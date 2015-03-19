<?php
require_once '..\..\application\autoload.php';
use tache\Controller\TacheController;
//var_dump("dada");die();
$taches = new TacheController();

$taches->postTache($_GET);

?>

<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 ">

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <h2 class="sub-header">Tableau de bord</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tâche</th>
                  <th>description</th>
                  <th>Echeance</th>
                  <th>Avancement par utilisateur </th>
                  <th>Avancement</th>
                  <th>Etat en Temps</th>
                  <th>Etat</th>
                  <th>Affectation</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
            <?php if(!empty($taches->ListesTaches())): ?>
            <?php foreach ($taches->ListesTaches() as $key => $value) : ?>
                  <?php //var_dump($taches->ListesTaches()) ?>
                <tr>
                  <td><?php echo $value['id_tache'] ?></td>
                  <td><?php echo $value['titre'] ?></td>
                  <td><?php echo $value['description'] ?>...</td>
                  <td><?php echo $value['echeance'] ?></td>
                  <td><?php echo $value['temps_passe'] ?></td>
                  <td><?php echo $value['temps totaux'][0]['time'] ?></td>
                  <td><?php echo $value['temps restant'] ?></td>
                  <td><?php echo $value['etat'] ?></td>
                  <td><?php echo $value['nom'] ?></td>
                  <td><a href="?tache=modif&idTache=<?php echo $value['id_tache'] ?>&idUser=<?php echo $value['userId'] ?>">modif</a></td>
                  <td><a href="?tache=supp&id=<?php echo $value['id_tache'] ?>">x</a></td>
                </tr>
            <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>