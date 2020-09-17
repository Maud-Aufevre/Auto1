<?php

require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/User.php');
require_once('../communs/Driver.php');

if(isset($_GET['id']) && isset($_GET['statut'])){
    $id = (int)$_GET['id'];
    $statut = (bool)$_GET['statut'];

    $driver = new Driver($connex);
    if($statut == 1){
        $statut = 0;
    }else{
        $statut = 1;
    }
    $nb = $driver->changeStatut($statut,$id);
    if($nb){
        header('location:listUsers.php');
    }
}

?>