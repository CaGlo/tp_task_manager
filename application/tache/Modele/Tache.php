<?php
namespace tache\Modele;
require_once dirname(dirname(__DIR__)) .'\Connexion.php';

class Tache{

    private $bdd;
    private $listes;
    private $tache = array();
    private $userTaches;
    private $users;
    private $user;
    private $titre;
    private $description;
    private $echeance;
    private $temps_prev;
    private $etat;
    


    public function __construct() {
        $this->bdd = \Connexion::getInstance();
        $this->listesTaches();
        $this->userTaches();
        

    }

    public function listesTaches() {

        $this->setListes($this->bdd->query('SELECT * FROM tache')->fetchAll(\PDO::FETCH_ASSOC));

    }
    
    public function setListes($listes) {
        
      $this->listes = $listes;
      return $this;
    }
    public function getListes() {
        return $this->listes;
    }
    
    public function save()
    {
         try {
            $reqBDD = $this->bdd->prepare("INSERT INTO tache VALUES"
                    . " ('',:titre,:description,:echeance,:temps_prev,'0')");
            $reqBDD->bindParam(':titre', $this->titre);
            $reqBDD->bindParam(':description', $this->description);
            $reqBDD->bindParam(':echeance', $this->echeance);
            $reqBDD->bindParam(':temps_prev', $this->temps_prev);
            $reqBDD->execute();
            return $this->bdd->lastInsertId();
            
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
    
    public function tache($id) {
        
        if(is_numeric($id)){
            $reqBDD = null;
        try {
                        
            $reqBDD = $this->bdd->prepare("SELECT * FROM tache WHERE id = :id");
            $reqBDD->bindParam(":id",$id);
            $reqBDD->execute();
            $res = $reqBDD->fetch(\PDO::FETCH_ASSOC);
           
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
        }
    }

    public function getTache() {
        return $this->tache;
    }

    public function setTache($tache) {
        $this->tache($tache);
    }
    

    
    public function users(){
        $this->setUsers($this->bdd->query('SELECT * FROM user')->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function setUsers($users) {
        $this->users = $users;
    }
    
    public function getUsers(){
        return $this->users;
    }
   
    
    public function userTaches(){
        $this->setUserTaches($this->bdd->query('SELECT * FROM user_tache')->fetchAll(\PDO::FETCH_ASSOC));
    }
    
    public function setUserTaches($userTaches){
        $this->userTaches = $userTaches;
    }
    
    public function getUserTaches(){
        return $this->userTaches;
    }
    
    public function user($id) {
        $reqBDD = null;
        try {
                       
            $reqBDD = $this->bdd->prepare("SELECT * FROM users WHERE id = :id");
            $reqBDD->bindParam(":id",$id);
            $reqBDD->execute();
            $res = $reqBDD->fetch(\PDO::FETCH_ASSOC);
           
            $this->user = $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        
        $this->user = $this->user($user);
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getEcheance() {
        return $this->echeance;
    }

    public function getTemps_prev() {
        return $this->temps_prev;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setEcheance($echeance) {
        $this->echeance = $echeance;
    }

    public function setTemps_prev($temps_prev) {
        $this->temps_prev = $temps_prev;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

     public function findAllTachesForUser()
    {
        
        $reqBDD = null;
        try {
                    
            $reqBDD = $this->bdd->prepare(
                    "SELECT ut.temps_passe,"
                    . " ut.id_user, "
                    . "ut.id_tache, "
                    . "t.id as tacheId, "
                    . "t.titre, "
                    . "t.description, "
                    . "t.echeance, "
                    . "t.temps_prev, "
                    . "t.etat, "
                    . "u.id as userId, "
                    . "u.login, "
                    . "u.password, "
                    . "u.nom, "
                    . "u.prenom, "
                    . "u.id_role "
                    . "FROM user_tache as ut "
                    . "join tache as t "
                    . "on t.id = ut.id_tache "
                    . "join users as u "
                    . "on u.id = ut.id_user");
            $reqBDD->execute();
            $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC);  
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }

    public function findTachesForUser($tache, $user)
    {
        
        $reqBDD = null;
        try {
                    
            $reqBDD = $this->bdd->prepare(
                    "SELECT ut.temps_passe ,ut.id_user, ut.id_tache, t.id as tacheId, t.titre, t.description, t.echeance, t.temps_prev, t.etat, u.id as userId, u.login, u.password, u.nom, u.prenom, u.id_role "
                    . "FROM user_tache as ut "
                    . "join tache as t on ut.id_tache = :idTache and t.id = :idTache "
                    . "join users as u on ut.id_user = :idUser and u.id = :idUser");
            $reqBDD->bindParam(":idTache", $tache, \PDO::PARAM_INT);
            $reqBDD->bindParam(":idUser", $user, \PDO::PARAM_INT);
            $reqBDD->execute();
            $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC);  
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
   public function delete($id) {
        $sql = "DELETE FROM tache WHERE id =  :id_tache";
            $stmt = $this->bdd->prepare($sql);
            $stmt->bindParam(':id_tache', $id, \PDO::PARAM_INT);  
            $stmt->execute();
    }
    
    public function suppression($id) {
        
    }
    
    public function sommeTempPasserTache($id) {
        $reqBDD = null;
        try {
                    
            $reqBDD = $this->bdd->prepare(
                    "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(temps_passe))) AS time FROM user_tache WHERE id_tache = :id_tache");
            $reqBDD->bindParam(':id_tache', $id, \PDO::PARAM_INT);  
            $reqBDD->execute();
            $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC); 
            var_dump($res);
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }




}


