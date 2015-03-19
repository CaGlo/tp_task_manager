<?php
require_once '../template/header.php';
use tache\Controller\TacheController;
$taches = new TacheController();
$listesTaches = $taches->ListesTaches();
$taches->postTache($_GET);

?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 ">

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Tableau de bord</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Titre</th>
                  <th>description</th>
                  <th>Echeance</th>
                  <th>Temps de réalisation <br>par utilisateur </th>
                  <th>Temps de réalisation <br>Total</th>
                  <th>Etat en Temps</th>
                  <th>Etat du tache</th>
                  <th>Affectation</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
            <?php if(!empty($listesTaches)): ?>
            <?php foreach ($taches->ListesTaches() as $key => $value) : ?>
                  
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
<?php require_once '../template/footer.php'; ?>
