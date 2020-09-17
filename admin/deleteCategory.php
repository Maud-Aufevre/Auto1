<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Driver.php');

$driver = new Driver($connex);

if(isset($_GET['id'])){
    $id_cat = $_GET['id'];
    $line = $driver->deleteCategory($id_cat);
    if($line){
        header('location:listCategory.php');
    }

}
?>