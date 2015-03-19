<?php
namespace tache\Controller;
use tache\Modele\Tache;

use UserTache\Controller\UserTacheController;

class TacheController {
    private $tacheTab = array();
    
    
    function __construct($tacheTab = null) {
        
        $this->tacheTab = $tacheTab;
    }

public function ListesTaches() {  
        $taches= new Tache();
       $v= $taches->getUserTaches();
        if(!empty($v)){
           
            
            foreach ($taches->findAllTachesForUser() as $key  => $value) {
                $value['etat']    = $this->etat($value['etat']);
                $value['echeance']   = $this->date( $value['echeance']);
                $value['description']   = $this->taille( $value['description']);
                $value['temps totaux'] = $taches->sommeTempPasserTache($value['id_tache']);
                $value['temps restant']= $this->tempsRestantPourtache($value['temps_prev'],$value['temps totaux'][0]['time']);
                $tacheTab[]=$value;
            }
            
            return $tacheTab;
        }
        return false;
    }
    
    public function etat($etat) {

        switch ($etat) {
            case "1":
               return  "Assignée";
                break;
            case "2":
                return  "En cours";
                break;
            case "3":
                return  "Terminée";
                break;
            default:
                return  " Rien ";
        }
    }
    
    public function date($param) {
        
        $dateCut = explode('-', $param);
        $dateSecond = explode(' ',$dateCut[2]);
        $date = $dateSecond[0].'/'.$dateCut[1].'/'.$dateCut[0];
        return $date;
        
    }
    
    public function taille($param) {
        return substr($param, 0, 255);
    }
    
    public function postTache($param) {
       $taches= new Tache;
                
        if(!empty($param)){
            if($param['tache'] == 'modif'){
                if((int)!empty($param['idTache']) || (int)!empty($param['idTache'])){
                    return $taches->findTachesForUser($param['idTache'],$param['idUser']);
                }else{
                    header('location:index.php');
                }
            }
            if($param['tache'] == 'supp'){
                
                $taches->delete($param['id']);
            }
        }
    }
    
    public function tempsRestantPourtache($tempsRealistion, $tempsExecution) {
      
        
        $checkTime = $this->ConvertTimeToSeconds($tempsRealistion);

        $timeExe = $this->ConvertTimeToSeconds($tempsExecution);
        
        if($timeExe < $checkTime ){
            $second =($checkTime - $timeExe);
            $diff = '<span class="text-success">Il reste encore du temps: '.$this->ConverSecondToTie($second).'</span>';
        
        return $diff ;  
        }
        if($timeExe > $checkTime ){
            $second =($timeExe-$checkTime);
            $this->CalculePourcentage($checkTime,$timeExe);
            $pourcent=$this->CalculePourcentage($checkTime,$timeExe);
            $diff = '<span class="text-danger">le temps est depassé de:<br/> '. $this->ConverSecondToTie($second).' sois de <b>'.sprintf('%.2f',$pourcent).'%</b></span>';
        
        return $diff ;  
        }
        
    }
    
    function ConvertTimeToSeconds($T)
    {
        $exp = explode(":",$T);
        $c = count($exp);
        $r = 0;
        if ($c == 2)
        {
            $r = (((int)$exp[0]) * 60) + ((int)$exp[1]);
        }else{
            $r = (((int)$exp[0]) * 3600) + (((int)$exp[1]) * 60) + ((int)$exp[2]);
        } 

        return $r;
    }
    
    public function ConverSecondToTie($T) {
        $init = $T;
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;
        
        return $hours.':'.$minutes.':'.$seconds;
    }
    
    
    public function CalculePourcentage($tempsRealistion, $tempsExecution) {
        
       $pourcent=(($tempsExecution-$tempsRealistion) /$tempsRealistion) * 100;
        if(20<$pourcent){
            return $pourcent;
        }
    }
    public function addTache()
    {
        $arrayTache = $this->getTacheTab();
        $tache = new Tache();
        $userT = new UserTacheController();
        
        $arrayListUsersT = array();
        
        $arrayListUsersT = $arrayTache['user'];
        unset($arrayTache['user']);
        
        $titre = $arrayTache['titre'];
        $desc = $arrayTache['description'];
        $eche = date('Y-m-d H:i:s',strtotime($arrayTache['echeance']));
        $temps_prev = date('H:i:s',strtotime($arrayTache['temps_prev']));
        $tache->setTitre($titre);
        $tache->setDescription($desc);
        $tache->setEcheance($eche);
        $tache->setTemps_prev($temps_prev);
        $id_tache = $tache->save();
        
        foreach($arrayListUsersT as $u)
        {
            $userT->addUserTaches($u,$id_tache);
        }
        
        
        
    }
    public function getTacheTab() {
        return $this->tacheTab;
    }

    public function setTacheTab($tacheTab) {
        $this->tacheTab = $tacheTab;
    }


}
