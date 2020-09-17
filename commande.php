<?php


if(isset($_GET)){
    $id = $_GET['id'];
    $marque = $_GET['marque'];
    $modele = $_GET['modele'];
}

// var_dump($_POST); 
if(isset($_POST['commander'])){
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['msg']);
    require_once('mail.php');

}

ob_start();
?>

<div class="container">
    <div class="text-center">
        <h2>Commander un véhicule : <?=$marque?> <?=$modele?></h2>
    </div>
    <?php if(isset($_POST['commander'])){if($mail->send()){ ?>
        <div class="alert alert-success">
            Votre demande a bien été envoyée !
        </div>
    <?php } } ?>
    <div class="row">
        
    
        <div class="offset-3 col-6">
            
            <form action="" method="post">
                <input type="hidden" name="prix" value="<?=$prix;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
                <input type="hidden" name="marque" value="<?=$marque;?>">
                <!-- //intégrer l'interface de paiment stripe au formulaire: -->
                <div class="form-group">
                    <label for="nom">Nom : </label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group">
                    <label for="nom">Prénom : </label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                </div>
                <div class="form-group">
                    <label for="nom">Email : </label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="msg">Votre message : </label>
                    <textarea class="form-control" id="msg" name="msg" cols="30" rows="10"></textarea>   
                </div>
                <div class="text-center">
                    <button name="commander" class="btn btn-primary" type="submit">Commander</button>
                </div>
                
            </form>
        </div>
        
    </div>

</div>   


<?php
$content = ob_get_clean();
require_once('gabarit.php');
?>

