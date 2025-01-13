<?php
require 'vendor/autoload.php';
use Supabase\CreateClient;

include('header.php');

$supabaseUrl = 'VOTRE_URL_SUPABASE';
$supabaseKey = 'VOTRE_CLE_SUPABASE';
$client = new CreateClient($supabaseUrl, $supabaseKey);

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
echo $ip;

if (!empty($email)) {
    // Vérification si l'utilisateur a déjà joué
    $result = $client
        ->from('joueurs')
        ->select('*')
        ->eq('email', $email)
        ->eq('date', $date)
        ->or('ip.eq.' . $ip)
        ->execute();

    if (count($result->data) > 0) {
        header('Location: iladejajoue.php');
    } else {
        include('jeu.php');
        
        // Insertion du nouveau joueur
        $client
            ->from('joueurs')
            ->insert([
                'username' => $username,
                'email' => $email,
                'date' => $date,
                'ip' => $ip
            ])
            ->execute();
    }
} else {
    header('Location: reserve.php');
}

include('footer.php');
?>
