<?php
namespace UserTache\Controller;
use UserTache\Modele\UserTache;

class UserTacheController {
    private $tacheTab = array();
    
    function __construct() {
        
    }

    
    public function ListesTaches() {

        $taches= new Tache;
      //$taches->setTache($value['id_tache'])
     $taches->setTache(2);
     var_dump($taches->getTache());
//        foreach ($taches->getUserTaches()as $key => $value) {
////            var_dump($taches->setTache($value['id_tache']));
////                exit(); 
//        }
       
    }
    
    public function addUserTaches($id_user,$id_tache)
    {
        $userT = new UserTache($id_user, $id_tache);
        $userT->save();
    }

}
