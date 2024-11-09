<?php

/**
 * 
 * Získá jednoho zaměstnance z databáze podle ID
 * 
 * @param object $connection - napojení na databázi
 * @param integer $id - id jednoho konkretního zaměstnance
 * 
 * @return mixed Assoc pole,ktere obsahuje informace o jednoho konkretním zaměstnance nebo vratí null, zda nebzl nalezen
 * 
 */

function getStaff ($connection, $id, $columns = "*") {
    $sql = "SELECT $columns
            FROM zamestnanec
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * 
 * Upravuje informace o zaměstnanci v databázi
 * 
 * @param object $connection - napojení na databázi
 * @param string $first_name - křesní jméno zaměstnance
 * @param string $second_name - přjmení zaměstnance
 * @param integer $age - věk zaměstnance
 * @param string $life - informace o zaměstnanci
 * @param string $contract - úvazek zaměstnance
 * @param integer $id - id zaměstnance
 * 
 * @return boolean true - pokud je upddatování úspěšné
 * 
 */

function updateStaff($connection, $first_name, $second_name, $age, $life, $contract, $id) {

    $sql = "UPDATE zamestnanec
                SET first_name = ?,
                    second_name = ?,
                    age = ?,
                    life = ?,
                    contract = ?
                WHERE id = ?";
                
    $stmt = mysqli_prepare($connection, $sql);

    if(!$stmt) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "ssissi",$first_name, $second_name, $age, $life, $contract, $id);

        if(mysqli_stmt_execute($stmt)) {
            return true;
            //redirectUrl("/www/admin/one-staff.php?id=$id");
        };
    }
}  


/**
 * 
 * vymaže zaměstnance z databáze podle daného ID
 * 
 * @param object $connection - propojení s databází
 * @param integer $id - id daného zaměstnance
 * 
 * @return boolean true - pokud dojde k úspěšnému vymazání zaměstnance
 */

function deleteStaff($connection, $id) {
    $sql = "DELETE 
            FROM zamestnanec
            WHERE id = ?";
    
    $stmt = mysqli_prepare($connection, $sql);

    if($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)) {
            return true;
        }
    }
}

/**
 * 
 * Vrátí všchny zaměstnance z databaze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden zaměstnanec
 */
function getAllStaff($connection, $columns = "*") {
    $sql = "SELECT $columns
            FROM zamestnanec" ;

    $result = mysqli_query($connection, $sql);

    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $staff = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $staff;
    }
}

/**
 * 
 * Přidá zaměstnance do databáze a přesměruje nás na profil zaměstnance
 * 
 * @param object - $connection připojení do databáze
 * @param string $first_name - křesní jméno zaměstnance
 * @param string $second_name - přjmení zaměstnance
 * @param integer $age - věk zaměstnance
 * @param string $life - informace o zaměstnanci
 * @param string $contract - úvazek zaměstnance
 * @param integer $id - id zaměstnance
 * 
 * @return int $id - id přidaného zaměstnance
 * 
 */
function createStaff($connection, $first_name, $second_name, $age, $life, $contract) {

    $sql = "INSERT INTO zamestnanec (first_name, second_name, age, life, contract ) 
    VALUES (?, ?, ?, ?, ?)";
    
    $statement = mysqli_prepare($connection, $sql);

    if($statement === false ) {
        echo mysqli_error($connection);
    }else {
        mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $contract);

        if(mysqli_stmt_execute($statement)) {
            $id = mysqli_insert_id($connection);
            return $id;
        } else {
                echo mysqli_stmt_error($statement);
            }
    }
}