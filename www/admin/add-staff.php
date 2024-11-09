<?php

require "../assets/database.php";
require "../assets/staff.php";
require "../assets/auth.php";
require "../assets/url.php";

session_start();

if( !isLoggedIn() ){
    die("Nepovolený přístup");
}

$first_name = null;
$second_name = null;
$age = null;
$life = null;
$contract = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $age = $_POST["age"];
    $life = $_POST["life"];
    $contract = $_POST["contract"];

    $connection = connectionDB();

    $id = createStaff($connection, $first_name, $second_name, $age, $life, $contract);

    if($id) {
        redirectUrl("/www/admin/one-staff.php?id=$id");
    } else {
        echo "Zaměstnanec nebyl vytvořen";
    }
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
    <title>Document</title>
</head>
<body>

<?php require "../assets/admin-header.php"; ?>
    
    <main>
        <section class="add-form">

        <?php require "../assets/form-staff.php"; ?>
        
        </section>
    </main>
    
    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>