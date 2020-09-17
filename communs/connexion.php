<?php
    try {
        $connex = new PDO('mysql:host=localhost;dbname=garage1','root','');
        $connex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo'connexion réussie';
    } catch (PDOException $e) {
        die($e->getMessage());
    }
?>