<?php

require "../classes/Database.php";
require "../classes/Staff.php";
require "../classes/Auth.php";

session_start();

if( !Auth::isLoggedIn() ){
    die("Nepovolený přístup");
}

$role = $_SESSION["role"];

$database = new Database();
$connection = $database->connectionDB();


if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $staff = Staff::getStaff($connection, $_GET["id"]);
}else {
    $staff = null;
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
    <link rel="stylesheet" href="../css/admin-one-staff.css">
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin-header.php"; ?>

    <main>
        <!--<section class="main-heading">
            <h1>Informace o zaměstnanci</h1>
        </section> -->

        <section class="one-staff">
            <?php if ($staff === null): ?>
                <p>Zaměstnanec nenalezen</p>
            <?php else: ?>
                <div class="one-staff-box">
                    <h2><?php echo htmlspecialchars($staff["first_name"]). " " .htmlspecialchars($staff["second_name"]) ?></h2>
                    <p>Věk <?= htmlspecialchars($staff["age"]) ?></p>
                    <p>Dodatečné informace: <?= htmlspecialchars($staff["life"]) ?></p>
                    <p>Úvazek: <?= htmlspecialchars($staff["contract"])?></p>
                </div>

                <?php if($role === "admin"): ?>
                    <div class="one-staff-buttons">
                        <a class="edit-one-staff" href="editing-staff.php?id= <?= $staff['id'] ?>">Editovat</a>
                        <a class="delete-one-staff" href="delete-staff.php?id= <?= $staff['id'] ?>">Vymazat</a>
                </div>


                <?php endif;?>

            <?php endif; ?>
        </section>

        <section class="buttons">
            
        </section>

    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>