<?php
/**
 * 
 * Přesměrovává na url adresu
 * 
 * @param string $path - adresa, na kterou se má přesměrovát
 * 
 * @return void
 */

function redirectUrl($path) {
    if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] =! "off") {
        $url_protocol = "https";
    }else {
        $url_protocol = "http";
    }

    header("location: $url_protocol://" .$_SERVER ["HTTP_HOST"] . $path);
}
