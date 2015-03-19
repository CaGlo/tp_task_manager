<?php 
require_once '../template/header.php';
use auth\Controller\UsersController;
$user = new UsersController();
$list_users = $user->listUsers();
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
                       echo "<option value='".$user['id_user']."'>".ucfirst($user['nom'])." ".ucfirst($user['prenom'])."</option>";

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
<?php require_once '../template/footer.php'; ?>