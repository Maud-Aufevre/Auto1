<?php
require_once('./communs/connexion.php');
require_once('./communs/Category.php');
require_once('./communs/Vehicule.php');
require_once('./communs/Driver.php');

$driver = new Driver($connex);
$dataCat = $driver->listCategories();
$dataVeh = $driver->listVehicule();

ob_start();

?>

    <?php foreach($dataCat as $cat){ ?>

        <h1 class="text-center bg-secondary text-white">Catégorie: <?=strtoupper($cat->getNom_cat())?></h1>  
        <div class="row m-3 bg-secondary">
  
        <?php foreach($dataVeh as $veh){ 
           if($cat->getId_cat() == $veh->getId_cat()){
        ?>
         <div class="col-4">
         <div class="card">
        <img class="card-img-top" src="./assets/images/<?=$veh->getImage();?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Marque: <?=$veh->getMarque();?></h5>
            <p class="card-text"><?=$veh->getDescription();?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Prix:  
               <span class="badge badge-primary">
                <?=$veh->getPrix();?> €
               </span>
            </li>
            <li class="list-group-item">  
                <?php if($veh->etat ==1){ ?>
               <span class="badge badge-success">
                Disponible
               </span>
                <?php }else{ ?>
                <span class="badge badge-secondary">
                Indisponible
               </span>
                <?php } ?>
            </li>
            <li class="list-group-item">Modèle:  <?=$veh->getModele();?></li>
            <li class="list-group-item">Pays:   <?=$veh->getPays();?></li>
            <li class="list-group-item">Année:  <?=$veh->getAnnee();?></li>
        </ul>
        <div class="card-body">
            <!--<a href="checkout.php?" class="card-link btn btn-danger">Acheter</a>    OU -->
            <form action="checkout.php" method="post">
                <input type="hidden" name="id" value="<?=$veh->getId_veh();?>">
                <input type="hidden" name="prix" value="<?=$veh->getPrix();?>">
                <input type="hidden" name="image" value="<?=$veh->getImage();?>">
                <input type="hidden" name="marque" value="<?=$veh->getMarque();?>">
                <?php if($veh->etat ==1){ ?>
                <button type="submit" class="card-link btn btn-danger">
                    Payer
                </button>
                <?php } ?>
                
            </form>
                <?php if($veh->etat ==0){ ?> 
                    <a href="commande.php?id=<?=$veh->getId_veh()?>&marque=<?=$veh->getMarque()?>&modele=<?=$veh->getModele()?>" class="card-link btn btn-warning">
                        Commander
                    </a>
                <?php } ?>
        </div>
        </div>

         </div>
        <?php  } } ?>
       
        </div>
    <?php } 
    
    
    $content = ob_get_clean();
    require_once('gabarit.php');?>

