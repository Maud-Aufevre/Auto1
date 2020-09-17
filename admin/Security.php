<?php
session_start();
class Security{

    public static function islogged(){
        if(!isset($_SESSION['Auth'])){
            header('location:index.php');
        }
    }
}
Security::islogged();