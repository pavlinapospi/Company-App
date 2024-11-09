<?php

require "../assets/database.php";
require "../assets/staff.php";
require "../assets/auth.php";

session_start();

if( !isLoggedIn() ){
    die("Nepovolený přístup");
}

$connection = connectionDB();


if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $staff = getStaff($connection, $_GET["id"]);
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
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Informace o zaměstnanci</h1>
        </section>

        <section>
            <?php if ($staff === null): ?>
                <p>Zaměstnanec nenalezen</p>
            <?php else: ?>
                <h2><?php echo htmlspecialchars($staff["first_name"]). " " .htmlspecialchars($staff["second_name"]) ?></h2>
                <p>Věk <?= htmlspecialchars($staff["age"]) ?></p>
                <p>Dodatečné informace: <?= htmlspecialchars($staff["life"]) ?></p>
                <p>Úvazek: <?= htmlspecialchars($staff["contract"])?></p>
            <?php endif; ?>
        </section>

        <section class="buttons">
            <a href="editing-staff.php?id= <?= $staff['id'] ?>">Editovat</a>
            <a href="delete-staff.php?id= <?= $staff['id'] ?>">Vymazat</a>
        </section>

    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>