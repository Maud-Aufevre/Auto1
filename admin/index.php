<?php

require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Driver.php');

if(isset($_POST['envoi']) && strlen($_POST['pass'])>=4 && !empty($_POST['login'])){
    $login = trim(htmlentities(addslashes($_POST['login'])));
    $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
    $driver = new Driver($connex);
    $error = $driver->signIn($login,$pass);
    
}
ob_start();
?>
;
<?php 


?>

<h1 class="h2 text-center"> <u>Formulaire de connexion</u></h1>
    <div class="row justify-content-center">
        <div class="col-6">
            <?php
                if(isset($error)){
                    echo"<div class='alert alert-danger text-center'>$error</div>";
                }
            ?>
      
        <form method="post" action="" class="">
            <div class="form-group">
            <label for="login">Login*: </label>
            <input type="text" id="login" name="login" placeholder="Entrer le login" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="pass">Mot de passe*: </label>
            <input type="password" id="pass" name="pass" placeholder="Entrer le mot de passe" class="form-control" required>
            </div>
            <button type="submit" name="envoi" class="btn btn-primary btn-block">Connectez-vous</button>
        
        </form>
        </div>
    </div>
<?php
$content = ob_get_clean();
require_once('template.php');
?>
