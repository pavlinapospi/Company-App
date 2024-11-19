<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$first_name = "";
    $second_name = "";
    $email = "";
    $message = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $errors = [];

    if ($first_name === ""){
        $errors[] = "Prosím, vložte do formuláře vaše křestní jméno.";
    }

    if ($second_name === ""){
        $errors[] = "Prosím, vložte do formuláře vaše příjmení.";
    }

    if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
        $errors[] = "Prosím, vložte do formuláře vaše email.";
    }

    if ($message === ""){
        $errors[] = "Prosím, napište do formuláře zprávu.";
    }

    if(empty($errors)){

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "pavlinapospisilova33@gmail.com";
            $mail->Password = "rskkkgklkflqwrip";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->CharSet = "UTF-8";
            $mail->Encoding = "base64";


            $mail->setFrom("pavlinapospisilova33@gmail.com");
            $mail->addAddress("Kersi33@seznam.cz"); 
            $mail->Subject = "Vyplněný kontaktní formulář";
            $mail->Body = "Jméno: {$first_name} {$second_name} \nEmail: {$email} \nZpráva: {$message}";


            $mail->send();

            echo "Zprava odeslana";
        } catch (Exception $e) {
            echo "zprava nebyla odeslana: ", $mail->ErrorInfo;
        }
    }

} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="./css/footer.css">

    <link rel="stylesheet" href="css/contact.css">

    <script src="https://kit.fontawesome.com/6ae792aad6.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    
    <?php require "assets/header.php"; ?>

    <main>
        <section class="errors">
            <?php if(!empty($errors)):?>
                <ul>
                    <?php foreach($errors as $one_error): ?>
                        <li><?= $one_error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif;?>
        </section>

        <section class="form">
            <form action="contact.php" method="POST">
                <input type="text" 
                        name="first_name" 
                        placeholder="Křestní jméno" 
                        value="<?= $first_name; ?>"
                        required><br>

                <input type="text" 
                        name="second_name" 
                        placeholder="Přjmení jméno" 
                        value="<?= $second_name; ?>"
                        required><br>

                <input type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="<?= $email; ?>"
                        required><br>

                <textarea name="message" 
                            placeholder="Vaše zpráva" 
                            required><?= $message; ?></textarea><br>

                <button>Odeslat dotaz</button>
            </form>
        </section>
    </main>



    <?php require "assets/footer.php"; ?>
    <script src="js/header.js"></script>
</body>
</html>