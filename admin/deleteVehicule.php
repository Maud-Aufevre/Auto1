<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Vehicule.php');
require_once('../communs/Driver.php');

// var_dump($_GET);
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $image = $_GET['image'];
    // die('ok');
    $driver = new Driver($connex);
    $nb = $driver->deleteVehicule($id);
    if($nb){
        unlink("../assets/images/".$image);
        header('location:listVehicule.php');
    }
    
}
// if(isset($_POST['soumis'])){
//     $id = (int)$_POST['id'];
//     $image = $_POST['image'];
//     $driver = new Driver($connex);
//     $nb = $driver->deleteVehicule($id);
//     if($nb){
//         unlink("../assets/images/".$image);
//         header('location:listVehicule.php');
//     }
    
// }