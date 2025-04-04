<?php
/**
 * Fichier de fonctions communes pour l'application Chasse aux Oeufs
 * Toutes les fonctions et traitements PHP qui doivent être exécutés avant l'affichage HTML
 */

// Initialiser la session si nécessaire
session_start();

/**
 * Fonction pour définir un cookie de manière sécurisée
 */
function setCookieSafe($name, $value, $expiry, $path = "/") {
    if (headers_sent()) {
        // Si les en-têtes ont déjà été envoyés, stockons dans la session
        $_SESSION[$name] = $value;
        return false;
    } else {
        return setcookie($name, $value, $expiry, $path);
    }
}

/**
 * Fonction pour récupérer la valeur d'un cookie ou d'une variable de session
 */
function getCookieValue($name, $default = '') {
    if (isset($_COOKIE[$name])) {
        return $_COOKIE[$name];
    } elseif (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }
    return $default;
}

/**
 * Obtenir l'adresse IP du client
 */
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>
