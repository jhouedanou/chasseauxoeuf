<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chasse aux œufs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div id="loginScreen">
            <h1>Chasse aux œufs</h1>
            <button id="startButton" class="btn btn-primary">Commencer</button>
        </div>

        <div id="gameScreen" style="display:none">
            <div id="timer">15</div>
            <div id="score">0</div>
            <div id="gameContainer">
                <img src="img/egg1.png" class="egg" onclick="collectEgg(this)">
                <img src="img/egg2.png" class="egg" onclick="collectEgg(this)">
                <img src="img/egg3.png" class="egg" onclick="collectEgg(this)">
                <img src="img/egg4.png" class="egg" onclick="collectEgg(this)">
                <img src="img/egg5.png" class="egg" onclick="collectEgg(this)">
                <img src="img/egg6.png" class="egg" onclick="collectEgg(this)">
            </div>
        </div>
    </div>

    <script>
        let score = 0;
        let timer = 15;

        document.getElementById('startButton').onclick = () => {
            document.getElementById('loginScreen').style.display = 'none';
            document.getElementById('gameScreen').style.display = 'block';
            startGame();
        };

        function startGame() {
            const timerInterval = setInterval(() => {
                timer--;
                document.getElementById('timer').textContent = timer;
                if (timer <= 0 || score >= 6) {
                    clearInterval(timerInterval);
                    endGame();
                }
            }, 1000);
        }

        function collectEgg(egg) {
            egg.style.display = 'none';
            score++;
            document.getElementById('score').textContent = score;
        }

        function endGame() {
            alert(`Jeu terminé! Score: ${score}`);
            location.reload();
        }
    </script>
</body>
</html>
