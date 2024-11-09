<?php

/**
 * 
 * Připojení se k databázi
 * 
 * @return objekt -pro připojení do databáze
 */

function connectionDB() {
    $db_host = "localhost";
    $db_user = "paja";
    $db_password = "admin123";
    $db_name = "firma";
    
    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $connection;
}

