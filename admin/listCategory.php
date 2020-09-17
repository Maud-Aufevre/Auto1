<?php
require_once('Security.php');
require_once('../communs/connexion.php');
require_once('../communs/Category.php');
require_once('../communs/Driver.php');

$driver = new Driver($connex);

$datas = $driver->listCategories();

//var_dump($datas);

ob_start();
?>
<h1 class="h2 text-center">Liste des catégories</h1>
<table class="table table-striped">
    <thead>
        <tr class="">
            <th>Id</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datas as $cat){ ?>
        <tr>
            <td><?=$cat->getId_cat(); ?></td>
            <td><?=$cat->getNom_cat(); ?></td>
            <td><?=$cat->getDate_cat(); ?></td>
            <td>
                <a class="btn btn-danger" href="deleteCategory.php?id=<?=$cat->getId_cat(); ?>"
                 onclick="return confirm('Etes sûr...')"> 
                <i class=" fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require_once('template.php');
?>
