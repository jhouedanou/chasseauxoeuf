<?php
include('header.php');
require_once('db.php');

$username = htmlspecialchars($_GET['username']);
$email = htmlspecialchars($_GET['email']);
setcookie("username", $username, time() + (86400 * 30), "/");
setcookie("email", $email, time() + (86400 * 30), "/");

$date = date("d-m-Y");
setcookie('datedujour', $date, time() + (86400 * 30), "/");

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Initialiser la base de données locale
$db = Database::getInstance();

if (!empty($email)) {
    // Vérification si le joueur existe
    if ($db->playerExists($email, $date)) {
        header('Location: iladejajoue.php');
        exit();
    } else {
        include('jeu.php');
        
        // Insertion du nouveau joueur dans la base de données locale
        $db->addPlayer($username, $email, $date, $ip);
    }
} else {
    header('Location: reserve.php');
}

include('footer.php');
?>
