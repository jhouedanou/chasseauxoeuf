<?php
// Charger les fonctions et la base de données avant tout output HTML
require_once('functions.php');
require_once('db.php');

// Récupérer et nettoyer les paramètres
$username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

// Définir les cookies de manière sécurisée
setCookieSafe("username", $username, time() + (86400 * 30), "/");
setCookieSafe("email", $email, time() + (86400 * 30), "/");

$date = date("d-m-Y");
setCookieSafe('datedujour', $date, time() + (86400 * 30), "/");

// Utiliser la fonction de functions.php pour obtenir l'IP
$ip = getClientIP();

// Initialiser la base de données locale
$db = Database::getInstance();

// Traitement et redirection basés sur l'email
if (!empty($email)) {
    // Vérification si le joueur existe
    if ($db->playerExists($email, $date)) {
        // Rediriger si le joueur existe déjà
        header('Location: iladejajoue.php');
        exit();
    } else {
        // Le joueur n'existe pas, nous allons l'ajouter et afficher le jeu
        $db->addPlayer($username, $email, $date, $ip);
        
        // Maintenant que tout le traitement PHP est terminé, nous pouvons inclure l'HTML
        include('header.php');
        include('jeu.php');
        include('footer.php');
        exit();
    }
} else {
    // Pas d'email fourni, rediriger vers la page de réservation
    header('Location: reserve.php');
    exit();
}
?>
