<?php
require_once('Security.php');
if($_SESSION['Auth']->role == 2){
    header('location:index.php');
}
require_once('../communs/connexion.php');
require_once('../communs/User.php');
require_once('../communs/Driver.php');

//var_dump($_POST);
if(isset($_POST['envoi']) && strlen($_POST['login'])>4 && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    
    $nom = trim(htmlentities(addslashes($_POST['nom'])));
    $prenom = trim(htmlentities(addslashes($_POST['prenom'])));
    $login = trim(htmlentities(addslashes($_POST['login'])));
    $email = trim(htmlentities(addslashes($_POST['email'])));
    $pass = trim(htmlentities(addslashes($_POST['pass'])));
    if(isset($_POST['admin'])){
        $role = (int)$_POST['admin'];
    }else{
        $role = 2;
    }

    $driver = new Driver($connex);
    $user = new User();
    $user->setNom($nom);
    $user->setPrenom($prenom);
    $user->setLogin($login);
    $user->setEmail($email);
    $user->setPass($pass);
    $user->setRole($role);

    $error = $driver->addUser($user);
}

ob_start();
?>
<h1 class="h2 text-center"> <u>Formulaire d'inscription</u></h1>
    <div class="row justify-content-center">
        <div class="col-6">
        <?php if(isset($error)){ ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="" class="">
            <div class="form-group">
            <label for="nom">Nom*: </label>
            <input type="text" id="nom" name="nom" placeholder="Entrer le nom" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="prenom">Prénom*: </label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrer le prenom" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="login">Login*: </label>
            <input type="text" id="login" name="login" placeholder="Entrer le login" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="email">Email*: </label>
            <input type="email" id="email" name="email" placeholder="Entrer l' email" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="pass">Mot de passe*: </label>
            <input type="password" id="pass" name="pass" placeholder="Entrer le mot de passe" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="admin">Administrateur*: </label>
            <input type="checkbox" value="1" id="admin" name="admin"  class="form-check">
            </div>
            <button type="submit" name="envoi" class="btn btn-primary btn-block">Connectez-vous</button>
        
        </form>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    require_once('template.php');