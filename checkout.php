<?php
var_dump($_POST);
if(isset($_POST)){
    $image = $_POST['image'];
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $id = $_POST['id'];
    
}
ob_start();
?>

<div class="row">
    <div class="col">
        <img src="./assets/images/<?=$image;?>" alt="" class="img-thumbnail">
    </div>
    <div class="col">
        <ul class="list-group">
            <li class="list-group-item">Marque : <?=$marque;?></li>
            <li class="list-group-item">Prix : <span class="badge badge-danger"><?=$prix;?> €</span></li>
        </ul>
        <div class="text-center">
            <form action="payment.php" method="post">
                <input type="hidden" name="prix" value="<?=$prix;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
                <input type="hidden" name="marque" value="<?=$marque;?>">
                <!-- //intégrer l'interface de paiment stripe au formulaire: -->
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51HRCbKCu5gpI0WMar5V2Xa9SZowX16QZVqH6wPcSCvKXcxeOPWOS3TBMqL8IrWM3HsQ3lkzhxkstJzHHBIPMEwvX005ngZvGPN" data-name="Auto1" data-descritpion="Les derniers véhicules de l'année" data-image="https://img2.freepng.fr/20180410/pyw/kisspng-the-mp-car-group-car-dealership-vehicle-auto-detai-car-logo-5acc63ad412f59.047531031523344301267.jpg" data-amont="<?=$prix;?>00" data-locale="auto" data-currency="eur" data-label="paiement par carte" data-billing-address="true"></script>
            </form>
        </div>   
    </div>
</div>


<?php
$content = ob_get_clean();
require_once('gabarit.php');
?>