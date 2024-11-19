<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Staff.php";
require "../classes/Auth.php";


session_start();

if( !Auth::isLoggedIn() ){
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

    $database = new Database();
    $connection = $database->connectionDB();

    $id = Staff::createStaff($connection, $first_name, $second_name, $age, $life, $contract);

    if($id) {
        Url::redirectUrl("/oop/Company-App/www/admin/one-staff.php?id=$id");
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

    <link rel="stylesheet" href="../css/admin-add-staff.css">
    <link rel="stylesheet" href="../query/admin-add-staff-query.css">
    

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