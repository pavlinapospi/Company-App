<?php

class Staff {

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

    public static function getStaff ($connection, $id, $columns = "*") {
        $sql = "SELECT $columns
                FROM zamestnanec
                WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try{
            if($stmt->execute()) {
                return $stmt->fetch();
            }else {
                throw new Exception("Získání dat o jednom zaměstnanci selhalo");
            }
        } catch (Exception $e) {
            error_log("chyba u funkce getStaff, získání dat selhalo\n", 3, "../errors/error.log");
            echo "Typ chyby:" . $e->getMessage();
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

    public static function updateStaff($connection, $first_name, $second_name, $age, $life, $contract, $id) {

        $sql = "UPDATE zamestnanec
                    SET first_name = :first_name,
                        second_name = :second_name,
                        age = :age,
                        life = :life,
                    contract = :contract
                    WHERE id = :id";
                
        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":contract", $contract, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try{
            if($stmt->execute()) {
                return true;
            }else {
                throw new Exception("Update zaměstnance se nepodařilo");
            }
        } catch (Exception $e) {
            error_log("chyba u funkce updateStaff, získání dat selhalo\n", 3, "../errors/error.log");
            echo "Typ chyby:" . $e->getMessage();
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

    public static function deleteStaff($connection, $id) {
        $sql = "DELETE 
                FROM zamestnanec
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try{
            if($stmt->execute()) {
                return true;
            }else {
                throw new Exception("Vymazání zaměstnance se nepodařilo");
            }
        } catch (Exception $e) {
            error_log("chyba u funkce deleteStaff\n", 3, ".//errors/error.log");
            echo "Typ chyby:" . $e->getMessage();
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
    public static function getAllStaff($connection, $columns = "*") {
        $sql = "SELECT $columns
                FROM zamestnanec" ;

        $stmt = $connection->prepare($sql);


        try{
            if($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else {
                throw new Exception("Získání všech dat o zaměstnancích selhalo");
            }
        } catch (Exception $e) {
            error_log("chyba u funkce getAllStaff\n", 3, ".//errors/error.log");
            echo "Typ chyby:" . $e->getMessage();
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
    public static function createStaff($connection, $first_name, $second_name, $age, $life, $contract) {

        $sql = "INSERT INTO zamestnanec (first_name, second_name, age, life, contract ) 
        VALUES (:first_name, :second_name, :age, :life, :contract)";
    
        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":contract", $contract, PDO::PARAM_STR);

        try{
            if($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            }else {
                throw new Exception("Vytvořní zaměstnancích selhalo");
            }
        } catch (Exception $e) {
            error_log("chyba u funkce createStaff\n", 3, ".//errors/error.log");
            echo "Typ chyby:" . $e->getMessage();
        }
    }
}