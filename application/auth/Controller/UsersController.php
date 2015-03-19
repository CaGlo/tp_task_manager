<?php

namespace auth\Controller;

use auth\Modele\Users;



/**
 * Description of UsersController
 *
 * @author CaGlo
 */
class UsersController
{
    
    private $id;
    private $login;
    private $password;
    private $nom;
    private $prenom;
    private $role;
    private $arrayTache = array();
    
    
    
    function __construct($id = null,$login = null ,$password = null,$nom = null,$prenom = null, $role = null, $arrayTache = null) {
        $this->id = '';
        $this->login = $login;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role = $role;
        $this->arrayTache = $arrayTache;
        return $this;
    }
    
    

    public function debugBDDFind()
    {
        $user = new Users();
        
        $req = $user->findById('1');
        
        return $req;
    }
    
    
    public function login()
    {
        $user = new Users();
        $login = $this->getLogin();
        $pass = $this->getPassword();
        $res = $user->findByLogin($login);        
        
//        $this->id = 
        if(!empty($res))
        { 
            if($res->getLogin() == $login && $res->getPassword() == $pass)
            {
                $this->setId($res->getId());
                $this->setNom($res->getNom());
                $this->setRole($res->getRole());
//                $this->setArrayTache($res->setArrayTacheDB());  
                return json_encode($this);
            }
           
        }else
        {
            return ("FALSE");
        }
        
    }
    
    public function listUsers()
    {
         $user = new Users();
         
         $list_users = $user->findAllUser();
         return $list_users;
    }
    
    public function logout()
    {
        session_destroy();
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

    public function getArrayTache() {
        return $this->arrayTache;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setArrayTache($arrayTache) {
        $this->arrayTache = $arrayTache;
    }


    
}
