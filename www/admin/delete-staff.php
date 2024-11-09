<?php

require "../assets/database.php";
require "../assets/staff.php";
require "../assets/auth.php";
require "../assets/url.php";

session_start();

if( !isLoggedIn() ){
    die("Nepovolený přístup");
}

$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(deleteStaff($connection, $_GET["id"])) {
        redirectUrl("/www/admin/staff.php");
    };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/6ae792aad6.js" crossorigin="anonymous"></script>
    <title>delete-staff</title>
</head>
<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="delate-form">
            <form method="POST">
                <p>Jste si jisti, že opravdu chcete zmazat tohoto zaměstnance?</p>
                <button>Smazat</button>
                <a href="one-staff.php?id= <?=$_GET['id']?>">Zrušit</a>
            </form>
        </section>
    </main>
    
    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>

