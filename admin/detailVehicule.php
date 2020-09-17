<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Vehicule.php');
require_once('../communs/Driver.php');

if(isset($_GET['id'])){
    $id_cat = $_GET['id'];
    $driver = new Driver($connex);
    $row = $driver->listVehicule($id_cat);
}
// var_dump($id_cat);
//var_dump($row[0]->getImage());
ob_start();
?>

<div class="card col-6 offset-3">
  <img class="card-img-top" src="../assets/images/<?=$row[0]->getImage(); ?>" alt="">
  <div class="card-body">
    <h5 class="card-title">
        <?=strtoupper($driver->getNameCat($row[0]->getId_cat())->getNom_cat()); ?> N°: <?=$row[0]->getId_veh();?> 
    </h5>
    <p class="card-text"><?=$row[0]->getDescription();?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Marque: <?=$row[0]->getMarque();?></li>
    <li class="list-group-item">Modele: <?=$row[0]->getModele();?></li>
    <li class="list-group-item">Prix: <?=$row[0]->getPrix();?>€</li>
    <li class="list-group-item">Annee: <?=$row[0]->getAnnee();?></li>
    <li class="list-group-item">Créé le: <?=$row[0]->getDate_veh();?></li>
  </ul>
  <!-- <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div> -->
</div>
<?php
$content = ob_get_clean();
require_once('template.php');
?>
