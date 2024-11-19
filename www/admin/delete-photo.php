<?php

require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Image.php";
require "../classes/Url.php";

session_start();

// Ověřuje, zda je uživatel přihlášený 
if( !Auth::isLoggedIn() ){
    die("Nepovolený přístup");
}

$db = new Database();
$connection = $db->connectionDB();

$user_id = $_GET["id"];
$image_name = $_GET["image_name"];

$image_path = "../uploads/" . $user_id . "/" . $image_name;

if(Image::deletePhotoFromDirectory($image_path)){
    //Smazat obrazek z databaze
    Image::deletePhotoFromDatabase($connection, $image_name);
    Url::redirectUrl("/oop/Company-App/www/admin/photos.php");
}