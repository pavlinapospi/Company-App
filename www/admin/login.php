<?php

require "../assets/database.php";
require "../assets/url.php";
require "../assets/user.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = connectionDB();
    $log_email = $_POST["login-email"];
    $log_password = $_POST["login-password"];

    if(authentication($conn, $log_email, $log_password)) {
        //ziskat id uzivatele
        $id = getUserId($conn, $log_email);
        
        //Zabraňuje provedení tzv. fixation attack. Více zde: https://owasp.org/www-community/attacks/Session_fixation
        session_regenerate_id(true);

        //Nastavení,že je užvatel přihlášen
        $_SESSION["is_logged_in"] = true;
        //Nastavení ID užvatele
        $_SESSION["logged_in_user_id"] = $id;

        redirectUrl("/www/admin/staff.php");

    } else {
        $error = "Chyba při přihlášení.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!empty($error)): ?>
        <p> <?= $error ?></p>
        <a href="../signin.php">Zpět na přihlášní</a>
    <?php endif; ?>
</body>
</html>