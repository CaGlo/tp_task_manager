<?php
namespace tache\Modele;
require_once dirname(dirname(__DIR__)) .'\Connexion.php';

class Tache{

    private $bdd;
    private $listes;
    private $tache;
    private $userTaches;
    private $users;
    private $user;


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



   




}


