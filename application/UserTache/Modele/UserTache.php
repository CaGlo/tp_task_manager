<?php
namespace UserTache\Modele;
require_once dirname(dirname(__DIR__)) .'\Connexion.php';

class UserTache{

    private $bdd;
    private $id_user;
    private $id_tache;
    private $temps_passe;


    public function __construct($id_u = null, $id_tache = null) {
        $this->bdd = \Connexion::getInstance();
        $this->id_user = $id_u;
        $this->id_tache = $id_tache;
    }

    public function listesUserTaches()
    {
        try {
            $reqBDD = $this->bdd->prepare("SELECT * FROM user_tache");
            $reqBDD->execute();
            $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC);
            
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
    
    
    
    public function save()
    {
        try {
            $reqBDD = $this->bdd->prepare("INSERT INTO user_tache VALUES ('00:00:00',:id_user,:id_tache)");
            $reqBDD->bindParam(':id_user', $this->id_user);
            $reqBDD->bindParam(':id_tache', $this->id_tache);
            $reqBDD->execute();
            
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
    
    public function getId_user() {
        return $this->id_user;
    }

    public function getId_tache() {
        return $this->id_tache;
    }

    public function getTemps_passe() {
        return $this->temps_passe;
    }

    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    public function setId_tache($id_tache) {
        $this->id_tache = $id_tache;
    }

    public function setTemps_passe($temps_passe) {
        $this->temps_passe = $temps_passe;
    }


   

}


