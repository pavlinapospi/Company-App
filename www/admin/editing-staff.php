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
    if( isset($_GET["id"]) ) {
        $one_staff = getStaff($connection, $_GET["id"]);

        if($one_staff) {
            $first_name = $one_staff["first_name"];
            $second_name = $one_staff["second_name"];
            $age = $one_staff["age"];
            $life = $one_staff["life"];
            $contract = $one_staff["contract"];
            $id = $one_staff["id"];
        } else {
            die("zaměstnanec nenalezen"); 
        }
    
    }else {
        die("ID není zadáno,zaměstnanec nebyl nenalezen");
    }


    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $contract = $_POST["contract"];

        if(updateStaff($connection, $first_name, $second_name, $age, $life, $contract, $id)) {
            redirectUrl("/www/admin/one-staff.php?id=$id");
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
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin-header.php"; ?>

    <?php require "../assets/form-staff.php"; ?>


    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>