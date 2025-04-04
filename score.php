<?php
// Charger les fonctions et la base de données avant tout output HTML
require_once('functions.php');
require_once('db.php');

// Récupération des données du joueur depuis les cookies et sessions
$username = getCookieValue("username", 'Joueur');
$email = getCookieValue("email", '');
$score = getCookieValue("score", '0');
$datedujourtoCheck = date("d-m-Y");

// Initialiser la base de données locale
$db = Database::getInstance();

// Mettre à jour le score du joueur dans la base de données locale
if (!empty($email) && !empty($score)) {
	$db->updateScore($email, $datedujourtoCheck, $score);
}

// Maintenant que tout le traitement est fait, on peut inclure l'HTML
include('header.php');
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
	Bonjour <?php echo htmlspecialchars($username); ?> !
</div>
<div class="score-container">
	🎮 Score: <?php echo htmlspecialchars($score); ?> points! 🎮
</div>

<?php
include('footer.php');
?>