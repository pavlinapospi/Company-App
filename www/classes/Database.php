<?php

class Database {
    /**
 * 
 * Připojení se k databázi
 * 
 * @return objekt -pro připojení do databáze
 */

    public function connectionDB() {
        $db_host = "localhost";
        $db_user = "paja";
        $db_password = "admin123";
        $db_name = "firma";
        
        $connection = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
        
        try {
            $db = new PDO($connection, $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

}