<?php
class Connexion
{
    private static $bdd;
    
    private function __construct() {
        self::$bdd = new \PDO('mysql:host=localhost;dbname=tp_gestion_tache;charset=utf8', 'root', '');
    }
    
    public static function getInstance()
    {
        if (null === self::$bdd) {
            new Connexion();
        }
        
        return self::$bdd;
    }
}