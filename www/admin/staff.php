<?php

require "../classes/Database.php";
require "../classes/Staff.php";
require "../classes/Auth.php";

session_start();

if(!Auth::isLoggedIn() ){
    die("Nepovolený přístup");
}

$database = new Database();
$connection = $database->connectionDB();


$staff = Staff::getAllStaff($connection, "id, first_name, second_name");

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

    <link rel="stylesheet" href="../css/admin-staff.css">
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Seznam zaměstnanců</h1>
        </section>

        <section class="filter">
            <input type="text" class="filter-input">
        </section>

        <section class="staffs-list">
            <?php if(empty($staff)): ?>
                <p>Žádný zaměstnanci nebyli nalezeni</p>
            <?php else: ?>
                <div class="all-staffs">

                    <?php foreach($staff as $one_staff): ?>
                        <div class="one-staff">
                            <h2><?php echo htmlspecialchars($one_staff["first_name"])." ".htmlspecialchars($one_staff["second_name"]) ?></h2>
                            <a href="one-staff.php?id=<?= $one_staff['id'] ?>">Více informací</a>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
    <script src="../js/filter.js"></script>
</body>
</html>