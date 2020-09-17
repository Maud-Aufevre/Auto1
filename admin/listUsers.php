<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/User.php');
require_once('../communs/Driver.php');

$driver = new Driver($connex);

$datas = $driver->listUsers();

//var_dump($datas);

ob_start();
?>
<h1 class="h2 text-center">Liste des catégories</h1>
<table class="table table-striped">
    <thead>
        <tr class="">
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datas as $user){ ?>
        <tr>
            <td><?=$user->getId(); ?></td>
            <td><?=$user->getNom(); ?></td>
            <td><?=$user->getPrenom(); ?></td>
            <td><?=$user->getLogin(); ?></td>
            <td><?=$user->getEmail(); ?></td>
            <td><?=$user->getRole(); ?></td>
            <td>
                <?php
                    if($user->getRole() == 1){
                        echo "administrateur";
                    }else{
                        echo "utilisateur";
                    }
                ?>
            </td>
            <?php
            if($user->getRole()==2){
                if($user->statut == 1){
            ?>
            <td>
                <a class="btn btn-success" href="changeStatut.php?id=<?=$user->getId()?>&statut=<?=$user->statut?>">
                Désactiver
                </a>
            </td>
            <?php }else{ ?>
                <td>
                <a class="btn btn-secondary" href="changeStatut.php?id=<?=$user->getId()?>&statut=<?=$user->statut?>">
                Activer
                </a>
            </td>
            <?php }} ?>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require_once('template.php');
?>
