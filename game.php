<?php
include('header.php');

$username = htmlspecialchars($_GET['username']);
$email = htmlspecialchars($_GET['email']);
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

$supabaseUrl = 'https://nbqssxhroavedcnjloys.supabase.co';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5icXNzeGhyb2F2ZWRjbmpsb3lzIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzIyODgzNzcsImV4cCI6MjA0Nzg2NDM3N30.nlYK3l6l4wDqeWEEMknBSsBzlt0bLlFLGkFkbaluZj0';

if (!empty($email)) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: ' . $supabaseKey,
        'Authorization: Bearer ' . $supabaseKey,
        'Content-Type: application/json'
    ]);

    // Vérification si le joueur existe
    $params = http_build_query([
        'email' => 'eq.' . $email,
        'date' => 'eq.' . $date
    ]);
    curl_setopt($ch, CURLOPT_URL, $supabaseUrl . '/rest/v1/joueurs?' . $params);
    $result = curl_exec($ch);
    $data = json_decode($result, true);

    if (!empty($data)) {
        header('Location: iladejajoue.php');
        exit();
    } else {
        include('jeu.php');
        
        // Insertion du nouveau joueur
        curl_setopt($ch, CURLOPT_URL, $supabaseUrl . '/rest/v1/joueurs');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'username' => $username,
            'email' => $email,
            'date' => $date,
            'ip' => $ip
        ]));
        curl_exec($ch);
    }
    curl_close($ch);
} else {
    header('Location: reserve.php');
}

include('footer.php');
?>
