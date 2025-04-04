<?php 
	include('header.php');
	require_once('db.php');
?>
	<style>
		.score-container {
			font-size: 2.5em;
			text-align: center;
			margin: 20px;
			padding: 20px;
			animation: bounce 1s infinite;
			color: #FF6B6B;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
		}

		@keyframes bounce {
			0%, 100% { transform: translateY(0); }
			50% { transform: translateY(-20px); }
		}

		.greeting {
			font-size: 1.5em;
			color: #4ECDC4;
			margin-bottom: 20px;
		}
	</style>

	<div class="greeting">
		Bonjour <?php echo isset($_COOKIE["username"]) ? htmlspecialchars($_COOKIE["username"]) : 'Joueur'; ?> !
	</div>
	<div class="score-container">
		🎮 Score: <?php echo isset($_COOKIE["score"]) ? htmlspecialchars($_COOKIE["score"]) : '0'; ?> points! 🎮
	</div>

<?php
	// Récupération des données du joueur depuis les cookies
	$usertoinsert = isset($_COOKIE["username"]) ? $_COOKIE["username"] : '';
	$emailtoCheck = isset($_COOKIE["email"]) ? $_COOKIE["email"] : '';
	$scoreToUpdate = isset($_COOKIE["score"]) ? $_COOKIE["score"] : 0;
	$datedujourtoCheck = date("d-m-Y");

	// Initialiser la base de données locale
	$db = Database::getInstance();

	// Mettre à jour le score du joueur dans la base de données locale
	if (!empty($emailtoCheck) && !empty($scoreToUpdate)) {
		$db->updateScore($emailtoCheck, $datedujourtoCheck, $scoreToUpdate);
	}

	include('footer.php');
?>