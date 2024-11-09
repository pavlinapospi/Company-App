<?php

require "../assets/database.php";
require "../assets/staff.php";
require "../assets/auth.php";

session_start();

if( !isLoggedIn() ){
    die("Nepovolený přístup");
}


$connection = connectionDB();
$staff = getAllStaff($connection, "id, first_name, second_name");

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
            <h1>Seznam zaměstnanců</h1>
        </section>

        <section>
            <?php if(empty($staff)): ?>
                <p>Žádný zaměstnanci nebyli nalezeni</p>
                <?php else: ?>
                    <ul>
                        <?php foreach($staff as $one_staff): ?>
                            <li>
                                <?php echo htmlspecialchars($one_staff["first_name"])." ".htmlspecialchars($one_staff["second_name"]) ?>
                            </li>
                            <a href="one-staff.php?id=<?= $one_staff['id'] ?>">Více informací</a>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>
</html>