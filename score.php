<?php 
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
		Bonjour <?php echo htmlspecialchars($_COOKIE["score"]); ?> !
	</div>
	<div class="score-container">
		🎮 Score: <?php echo htmlspecialchars($_COOKIE["score"]); ?> points! 🎮
	</div>

<?php
	$usertoinsert = $_COOKIE["username"];
	$emailtoCheck = $_COOKIE["email"];
	$datedujourtoCheck = date("d-m-Y");

	
$supabaseUrl = 'https://nbqssxhroavedcnjloys.supabase.co';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5icXNzeGhyb2F2ZWRjbmpsb3lzIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzIyODgzNzcsImV4cCI6MjA0Nzg2NDM3N30.nlYK3l6l4wDqeWEEMknBSsBzlt0bLlFLGkFkbaluZj0';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $supabaseUrl . '/rest/v1/joueurs');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'apikey: ' . $supabaseKey,
		'Authorization: Bearer ' . $supabaseKey,
		'Content-Type: application/json',
		'Prefer: return=minimal'
	]);

	$data = json_encode([
		'score' => $_COOKIE["score"]
	]);

	$params = http_build_query([
		'email' => 'eq.' . $emailtoCheck,
		'date' => 'eq.' . $datedujourtoCheck
	]);

	curl_setopt($ch, CURLOPT_URL, $supabaseUrl . '/rest/v1/joueurs?' . $params);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	curl_close($ch);

	include('footer.php');
?>