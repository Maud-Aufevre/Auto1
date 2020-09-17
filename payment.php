<?php
require_once('./communs/Driver.php');
require_once('./communs/connexion.php');
//require toutes les class stripe:
require_once('./vendor/autoload.php');
// var_dump($_POST);
if(isset($_POST) && !empty($_POST['stripeToken'])){
    $token = $_POST['stripeToken'];
    $prix = $_POST['prix'];
    $id = (int)$_POST['id'];
    $marque = $_POST['marque'];
    $numero = uniqid();

    //recup les infos pour créditer le compte bancaire grace à la clé privée de stripe:

    \Stripe\Stripe::setApiKey('sk_test_51HRCbKCu5gpI0WMa1BRjk8L5eexdd8ZeI8KOD6qvaZIoUQAsNDQmDGa1kkpP2sg8fLPxXMrAsbGGy8dLj2yR5vyJ00I5eVAC33');

    $charge = \Stripe\Charge::create([
        'amount'=>$prix.'00',
        'currency'=>'eur',
        'description'=>'vente de véhicule',
        'source'=>$token
    ]);

    if($charge['captured']){
        $driver = new Driver($connex);
        $nb = $driver->switchEtat(0,$id);
        if($nb){
            require_once('billing.php');
        }
    }
}

?>