<?php

require "../assets/url.php";
require "../assets/database.php";
require "../assets/user.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $connection = connectionDB();

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $id = createUser($connection, $first_name, $second_name, $email, $password);

    if(!empty($id)) {
        //Zabraňuje provedení tzv. fixation attack. Více zde: https://owasp.org/www-community/attacks/Session_fixation
        session_regenerate_id(true);

        $_SESSION["is_logged_in"] = true;
        
        $_SESSION["logged_in_user_id"] = $id;

        redirectUrl("/www/admin/staff.php");
    } else {
        echo "Uživatele se nepodařilo přihlásit";
    }
} else {
    echo "Nepovolený přístup";
}
