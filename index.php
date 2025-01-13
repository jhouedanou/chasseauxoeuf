<?php include('header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="text-center mt-5 mb-4">
                <h1 class="display-4">Connexion à la chasse aux œufs</h1>
            </div>
            <div id="userInfo" class="mb-3"></div>
            <div class="d-grid gap-2">
                <button id="connectButton" class="btn btn-primary btn-lg">
                    Se connecter
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('connectButton').addEventListener('click', async () => {
        try {
            const response = await fetch('https://randomuser.me/api/');
            const data = await response.json();
            const user = data.results[0];
            
            const username = user.login.username;
            const email = user.email;
            
            window.location.href = `game.php?username=${encodeURIComponent(username)}&email=${encodeURIComponent(email)}`;
        } catch (error) {
            console.error('Erreur de connexion:', error);
            document.getElementById('userInfo').innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Une erreur est survenue lors de la connexion. Veuillez réessayer.
                </div>
            `;
        }
    });
</script>

<?php include('footer.php'); ?>
