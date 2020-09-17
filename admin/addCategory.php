<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Driver.php');

if(isset($_POST['ajout']) && !empty($_POST['cat'])){
    $nom_cat = trim(htmlspecialchars($_POST['cat']));
    $driver = new Driver($connex);
    $newCat = new Category();
    $newCat->setNom_cat($nom_cat);
    $nb = $driver->addCategory($newCat);

    if($nb){
        header('location:listCategory.php');
    }

}

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de catégorie</title>
</head>
<body>
    <h1 class="h2 text-center"> <u>Ajouter une catégorie</u></h1>
    <div class="row justify-content-center">
        <div class="col-4">
        <form method="post" action="" class="">
            <div class="form-group">
            <label for="cat">Catégorie: </label>
            <input type="text" id="cat" name="cat" placeholder="Entrer la catégorie" class="form-control">
            </div>
            <button type="submit" name="ajout" class="btn btn-primary btn-block">Insérer</button>
        
        </form>
        </div>
    </div>
</body>
</html>
<?php
$content = ob_get_clean();
require_once('template.php');
?>