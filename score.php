<?php 
	include('header.php');?>
<?php 
	echo 'Bonjour ' . htmlspecialchars($_COOKIE["score"]) . '!';
	$usertoinsert = $_COOKIE["username"];
	$emailtoCheck = $_COOKIE["email"];
	$datedujourtoCheck  = date("d-m-Y");
	//connect to the database 
	$db = new PDO('mysql:host=localhost;dbname=easteregg;charset=utf8', 'root', 'root');
	//update the score of the user in the database
	$query = $db->prepare('UPDATE joueurs SET score = :score WHERE email = :email AND date :date');
	$query->execute(array(
		'score' => $usertoinsert,
		'email' => $emailtoCheck,
		'date' => $datedujourtoCheck
	));
?>
<?php
	include('footer.php'); 
?>