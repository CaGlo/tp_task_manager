<?php

namespace auth\Modele;



require_once dirname(dirname(__DIR__)) .'\Connexion.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author CaGlo
 */
class Users {
    //put your code here
    
    private $id,
            $login,
            $password,
            $nom,
            $prenom,
            $role,
            $arrayTache = array(),
            $bdd;
    
    public function __construct() {
        $this->bdd = \Connexion::getInstance();
       
    }

    
    public function findAllUser()
    {
        $reqBDD = null;
        try {
                       
            $reqBDD = $this->bdd->prepare("SELECT * FROM users WHERE id_role = 2");
            $reqBDD->execute();
            $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC);
            
            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
        
    public function findById($varID)
    {
      
        $reqBDD = null;
        try {
                       
            $reqBDD = $this->bdd->prepare("SELECT * FROM users WHERE id = :id");
            $reqBDD->bindParam(":id",$varID);
            $reqBDD->execute();
            $res = $reqBDD->fetch(\PDO::FETCH_ASSOC);
            
            $this->id = $res["id_user"];
            $this->login = $res["login"];
            $this->password = $res["password"];
            $this->nom = $res['nom'];
            $this->prenom = $res['prenom'];
            $this->role = $res['id_role'];
            
            
            return json_encode($this);
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
        
    }
    
    
    
    public function findByLogin($varLogin)
    {
         $reqBDD = null;
        try {
                       
            $reqBDD = $this->bdd->prepare("SELECT * FROM users WHERE login = :login");
            $reqBDD->bindParam(":login",$varLogin);
            $reqBDD->execute();
            $res = $reqBDD->fetch(\PDO::FETCH_ASSOC);
            
            $this->id = $res["id_user"];
            $this->login = $res["login"];
            $this->password = $res["password"];
            $this->nom = $res['nom'];
            $this->prenom = $res['prenom'];
            $this->role = $res['id_role'];
            
           
            return $this;
//            return $res;
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getRole() {
        return $this->role;
    }
    
     public function setRole($role) {
        $this->role = $role;
    }
    
    
    public function getArrayTache() {
        return $this->arrayTache;
    }

    public function setArrayTache($arrayTache) {
        $this->arrayTache = $arrayTache;
    }
    
    public function setArrayTacheDB()
    {
        $reqBDD = null;
        
        try {
                       
            $reqBDD = $this->bdd->prepare("SELECT * "
                    . "FROM tache as T, user_tache as UT "
                    . "WHERE UT.id_tache = T.id"
                    . " AND UT.id = :id");
//            $reqBDD = $this->bdd->prepare("SELECT T.id, T.titre, T.description,"
//                    . " T.echeance, T.temps_prev,"
//                    . " T.etat"
//                    . "FROM tache as T, user_tache as UT"
//                    . "WHERE UT.id = :id"
//                    . " WHERE UT.id_tache = T.id");
            $reqBDD->bindParam(":id",$this->id);
            $reqBDD->execute();
           $res = $reqBDD->fetchAll(\PDO::FETCH_ASSOC);
           
           $this->arrayTache['tache'] = $res;
            
           return $this;
//           foreach($res as $key => $value)
//           {
//               var_dump($key);
//               var_dump($value);
//           }
        } catch (Exception $e) {
            die("Erreur SQL !! ");
        }
    }

    public function getTache($index)
    {
        $arrTMP = $this->arrayTache;
        foreach ($arrTMP as $value)
        {
            var_dump($value);
        }
        die();
    }

}
