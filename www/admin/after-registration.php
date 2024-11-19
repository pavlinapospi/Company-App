<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";


session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $database = new Database();
    $connection = $database->connectionDB();

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = "user";

    $id = User::createUser($connection, $first_name, $second_name, $email, $password, $role);

    if(!empty($id)) {
        //Zabraňuje provedení tzv. fixation attack. Více zde: https://owasp.org/www-community/attacks/Session_fixation
        session_regenerate_id(true);

        //Nastavení,že je užvatel přihlášen
        $_SESSION["is_logged_in"] = true;
        //Nastavení ID užvatele
        $_SESSION["logged_in_user_id"] = $id;
        //Nastavení role užvatele
        $_SESSION["role"] = $role;

        Url::redirectUrl("/oop/Company-App/www/admin/staff.php");
    } else {
        echo "Uživatele se nepodařilo přihlásit";
    }
} else {
    echo "Nepovolený přístup";
}