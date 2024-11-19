<?php

class Auth {
    /**
    * 
    * Ověřuje, zda je uživatel přihlášený nebo ne
    * 
    * 
    *  @return boolean true - pokud je užvatel přihlášený,jinak false
    */
    public static function isLoggedIn() {
        return isset($_SESSION["is_logged_in"]) and $_SESSION ["is_logged_in"];
    }
}