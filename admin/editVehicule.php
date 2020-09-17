<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Vehicule.php');
require_once('../communs/Driver.php');

$driver = new Driver($connex);
$datas = $driver->listCategories();

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $veh = $driver->listVehicule($id);
    $nameCat = $driver->getNameCat($veh[0]->getId_cat())->getNom_cat();
    ///var_dump($nameCat); die;

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
    
        //$veh = new Vehicule();
        
        $veh[0]->setMarque($marque);
        $veh[0]->setModele($modele);
        $veh[0]->setPays($pays);
        $veh[0]->setPrix($prix);
        $veh[0]->setAnnee($annee);
        $veh[0]->setImage($image);
        $veh[0]->setDescription($description);
        $veh[0]->setId_cat($categorie);

        $nb = $driver->updateVehicule($veh[0]);
        if($nb){
            header('location:listVehicule.php');
        }
    }
    
}

ob_start();
?>
<h1 class="h2 text-center">Modifier un véhicule N°: <?=$veh[0]->getId_veh();?></h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
    <div class="form-group col">
        <label for="marque">Marque:</label>
        <input type="text" value="<?=$veh[0]->getMarque();?>" name="marque" id="marque" placeholder="Entrer la marque" class="form-control">
    </div>
    <div class="form-group col">
        <label for="modele">Modele:</label>
        <input type="text" value="<?=$veh[0]->getModele();?>" name="modele" id="modele" placeholder="Entrer le modele" class="form-control">
    </div>
  
    <div class="form-group col">
        <label for="pays">Pays:</label>
        <input type="text" value="<?=$veh[0]->getPays();?>" name="pays" id="pays" placeholder="Entrer le pays" class="form-control">
    </div>
    </div>
    <div class="row">
    <div class="form-group col">
        <label for="prix">Prix:</label>
        <input type="number" value="<?=$veh[0]->getPrix();?>" name="prix" id="prix" placeholder="Entrer le prix" class="form-control">
    </div>
   
    <div class="form-group col">
        <label for="annee">Année:</label>
        <input type="number" value="<?=$veh[0]->getAnnee();?>" name="annee" id="annee" placeholder="Entrer l'annee" class="form-control">
    </div>

    </div>
    <div class="row">
    <div class="form-group col">
        <label for="image">Image:</label>
        <input type="File" name="image" id="image"  class="form-control">
        <img src="../assets/images/<?=$veh[0]->getImage();?>" width="100" alt="">
    </div>
    <div class="form-group col">
        <label for="categorie">Catégorie:</label>
        <select name="categorie" id="categorie" class="form-control">
        <option hidden value="<?=$veh[0]->getId_cat();?>"><?=$nameCat;?></option>
        <?php foreach($datas as $cat){ ?>  
        <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
        <?php } ?>
        </select>
    </div>
    </div>
    <div class="form-group col">
        <label for="description">Description:</label>
        <textarea placeholder="Entrer la description" class="form-control" name="description" id="description" cols="30" rows="10"><?=$veh[0]->getDescription();?></textarea>
    </div>

    <button type="submit" name="soumis" class="btn btn-warning btn-block">Modifier</button>
</form>
<?php
$content = ob_get_clean();
require_once('template.php');
?>