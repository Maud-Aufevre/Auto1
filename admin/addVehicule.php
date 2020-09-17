<?php
require_once('Security.php');
//define('ROOT', dirname(__DIR__));
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Vehicule.php');
require_once('../communs/Driver.php');

$driver = new Driver($connex);
$datas = $driver->listCategories();

if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['categorie'])){
    $marque = trim(htmlentities(addslashes($_POST['marque'])));
    $modele = trim(htmlentities(addslashes($_POST['modele'])));
    $pays = trim(htmlentities(addslashes($_POST['pays'])));
    $prix = (int)trim(htmlentities(addslashes($_POST['prix'])));
    $annee = (int)trim(htmlentities(addslashes($_POST['annee'])));
    $description = trim(htmlentities(addslashes($_POST['description'])));
    $categorie = (int)trim(htmlentities(addslashes($_POST['categorie'])));
    $image = $_FILES['image']['name'];

    $destination = '../assets/images/';
    move_uploaded_file($_FILES['image']['tmp_name'], $destination.$image);

    $veh = new Vehicule();
    
    $veh->setMarque($marque);
    $veh->setModele($modele);
    $veh->setPays($pays);
    $veh->setPrix($prix);
    $veh->setAnnee($annee);
    $veh->setImage($image);
    $veh->setDescription($description);
    $veh->setId_cat($categorie);

    $nb = $driver->addVehicule($veh);

    if($nb){
        header('location:listVehicule.php');
    }else{
        echo "Echec l'ors de l'insertion";
    }

}

ob_start();
?>
<h1 class="h2 text-center">Ajout d'un véhicule</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
    <div class="form-group col">
        <label for="marque">Marque:</label>
        <input type="text" name="marque" id="marque" placeholder="Entrer la marque" class="form-control">
    </div>
    <div class="form-group col">
        <label for="modele">Modele:</label>
        <input type="text" name="modele" id="modele" placeholder="Entrer le modele" class="form-control">
    </div>
  
    <div class="form-group col">
        <label for="pays">Pays:</label>
        <input type="text" name="pays" id="pays" placeholder="Entrer le pays" class="form-control">
    </div>
    </div>
    <div class="row">
    <div class="form-group col">
        <label for="prix">Prix:</label>
        <input type="number" name="prix" id="prix" placeholder="Entrer le prix" class="form-control">
    </div>
   
    <div class="form-group col">
        <label for="annee">Année:</label>
        <input type="number" name="annee" id="annee" placeholder="Entrer l'annee" class="form-control">
    </div>

    </div>
    <div class="row">
    <div class="form-group col">
        <label for="image">Image:</label>
        <input type="File" name="image" id="image"  class="form-control">
    </div>
    <div class="form-group col">
        <label for="categorie">Catégorie:</label>
        <select name="categorie" id="categorie" class="form-control">
        <option hidden>Choisir une catégorie</option>
        <?php foreach($datas as $cat){ ?>  
        <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
        <?php } ?>
        </select>
    </div>
    </div>
    <div class="form-group col">
        <label for="description">Description:</label>
        <textarea placeholder="Entrer la description" class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
    </div>

    <button type="submit" name="soumis" class="btn btn-primary btn-block">Soumettre</button>
</form>
<?php

$content = ob_get_clean();
require_once('template.php');
?>