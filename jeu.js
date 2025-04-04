//animation de chargement 
$(window).load(function () {
	$(".loader").fadeOut("1000");
	$('#gamecontainer').fadeIn("1000");
	$('#containerDesInformations').fadeIn("1000");
});
let compteur = 0;
var container = document.querySelector('.container');
let score = 0;
document.cookie = "score=" + score;
let oeufs = document.querySelectorAll('.oeuf');
let userLang = navigator.language || navigator.userLanguage;
let confetti = document.getElementById('confetti');
confetti.remove();
function confettis() {
	document.getElementById('containerDesInformations').append(confetti);
}

//timer pour le decompte
let secondes = 15;
let timer = setInterval(gagnePerdu, 1000);
function gagnePerdu() {
	secondes--;
	document.getElementById('affichagedecompte').innerHTML = secondes;
	if (secondes == 0) {
		gagne();
	}
}
//ajout des scores 
function gagne() {
	clearInterval(timer);
	document.getElementById('affichagedecompte').innerHTML = '0';
	document.getElementById('gamecontainer').style.display = 'none';
	if (compteur == 0) {
		if (userLang == 'fr') {
			document.getElementById('affichageresultat').innerHTML = 'Vous avez perdu !';
		} else {
			document.getElementById('affichageresultat').innerHTML = 'You have lost !';
		}
	} else if (compteur == 1) {
		if (userLang == 'fr') {
			document.getElementById('affichageresultat').innerHTML = `Vous avez trouvé ${compteur} oeuf . Veuillez réessayer demain`
		} else {
			document.getElementById('affichageresultat').innerHTML = `You have found ${compteur} egg . Please try again tomorrow`;
			confettis();
		}
	} else if ((compteur > 1) && (compteur < 4)) {
		if (userLang == 'fr') {
			document.getElementById('affichageresultat').innerHTML = `Vous avez trouvé ${compteur} oeufs . Bien`
		} else {
			document.getElementById('affichageresultat').innerHTML = `You have found ${compteur} eggs . Good job !`;
			confettis();
		}
	}
	//redirection vers la page de score
	window.location.replace("score.php");

}

//decompte des oeufs
function compterOeufs() {
	var oeufs = document.getElementsByClassName("oeuf");
	for (var i = 0; i < oeufs.length; i++) {
		oeufs[i].addEventListener("click", function () {
			this.style.display = "none";
			compteur++;
			//creer un cookie avec le score de l'utilisateur
			score = compteur;
			document.cookie = "score=" + score;
			if (compteur == 6) {
				if(userLang == 'fr'){
					document.getElementById('affichageresultat').innerHTML = "Félicitations.Vous avez trouvé l'ensemble des oeufs !";
				}else{
					document.getElementById('affichageresultat').innerHTML = 'Congratulations, You have found all the eggs !';
				}
				gagne();
				console.log(compteur);
			} else {
				console.log(compteur);
			}
		});
	}
}
document.onload = compterOeufs();

//traduction en fonction de la langue du navigateur
if (userLang == 'fr') {
	document.getElementById('titreFr').style.display = 'block';
	document.getElementById("timerFr").style.display = "block";
	document.getElementById("secondesfr").style.display = "block";
} else {
	document.getElementById('titreEn').style.display = 'block';
	document.getElementById("timerEn").style.display = "block";
	document.getElementById("secondesen").style.display = "block";

}


