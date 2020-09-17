<?php

require_once('Security.php');

define('ROOT', dirname(__DIR__));
require_once(ROOT.'/communs/connexion.php');
require_once(ROOT.'/communs/Category.php');
require_once(ROOT.'/communs/Vehicule.php');
require_once(ROOT.'/communs/Driver.php');

$driver = new Driver($connex);
$rows = $driver->listVehicule();

if(isset($_POST['envoi']) && !empty($_POST['search'])){
    $search = trim(htmlentities(addslashes($_POST['search'])));
    $rows = $driver->listVehicule("",$search);
}

ob_start();
?>

<h1 class="h2 text-center"><u>Liste des véhicules</u></h1>
    <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Recherche..." aria-label="" aria-describedby="">
            <div class="input-group-append">
                <button name="envoi" class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
   </form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Marque</th>
            <th>Modele</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Catégorie</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row){ ?>
        <tr>
            <td><?=$row->getId_veh(); ?></td>
            <td><?=$row->getMarque(); ?></td>
            <td><?=$row->getModele(); ?></td>
            <td><?=$row->getPrix(); ?></td>
            <td><img src="../assets/images/<?=$row->getImage();?>" width="50" alt=""></td>
            <td><?=$driver->getNameCat($row->getId_cat())->getNom_cat(); ?></td>
            <td class="text-center d-flex justify-content-between">
                <a href="detailVehicule.php?id=<?=$row->getId_veh(); ?>" class="btn btn-info"><i class="fa fa-info-circle"></i> Détail</a>

                <?php 
                if(isset($_SESSION['Auth'])){
                    if($_SESSION['Auth']->role == 1){ 
                ?>

                <a href="editVehicule.php?id=<?=$row->getId_veh(); ?>" class="btn btn-warning"><i class="fa fa-pencil"></i>Edit</a> 
                
                <!-- <form action="deleteVehicule.php" method="post">
                <input type="hidden" name="id" value="<?=$row->getId_veh(); ?>">
                <input type="hidden" name="image" value="<?=$row->getImage(); ?>">
                <button onclick="return confirm('Etes vous sûr');" type="submit" class="btn btn-danger" name="soumis"><i class="fa fa-trash"></i> Supprimer</button>
                </form> -->
                <a onclick="return confirm('Voulez-vous supprimer?')" href="deleteVehicule.php?id=<?=$row->getId_veh(); ?>&image=<?=$row->getImage(); ?>" class="btn btn-danger"><i class="fa fa-trash"></i>Supp</a>
                <?php }} ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$content = ob_get_clean();
require_once('template.php');
?>
    

