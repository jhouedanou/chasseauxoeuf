<div class="row loader">
    <div class="egg"></div>
    <div class="egg egg2"></div>
    <div class="egg egg3"></div>
    <div class="egg egg4"></div>
</div>
    <div id="containerDesInformations" class="d-flex">
        <?php
        $json = file_get_contents('strings.json');
        $data = json_decode($json, true);
        $titrefr = $data['titrefr'];
        $titreen = $data['titreen'];
        $restefr = $data['restefr'];
        $resteen = $data['resteen'];
        $secondesfr = $data['secondesfr'];
        $secondesen = $data['secondesen'];
        ?>
        <div id="titre">
            <h1 id="titreFr" class="titre">
                <?php echo $titrefr;?>
            </h1>
            <h1 id="titreEn" class="titre">
                <?php echo $titreen;?>
            </h1>
        </div>
        <div id="decompte">
            <div id="legendedecompte">
                <p id="timerFr" class="letimer">
                    <?php echo $restefr;?>
                </p>
                <p id="timerEn" class="letimer">
                    <?php echo $resteen;?>
                </p>
            </div>
            <div id="affichagedecompte">
            </div>
            <div id="nombredesecondes">
                <p id="secondesfr" class="secnd">
                    <?php echo $secondesfr ?>
                </p>
                <p id="secondesen" class="secnd">
                    <?php echo $secondesen ?>
                </p>
            </div>
        </div>
        <div id="affichageresultat"></div>
    </div>
    <div id="gamecontainer">
        <!-- arbres -->
        <img src="img/arbres.png" alt="" id="arbres" class="decor">
        <img src="img/egg1.png" alt="egg1" id="egg1" class="oeuf">
        <!-- herbes -->
        <img src="img/background1.png" alt="" id="herbes" class="decor">
        <img src="img/egg2.png" alt="egg2" id="egg2" class="oeuf">
        <!-- tetedulapin -->
        <img src="img/tetelapin.png" alt="" id="tetelapin" class="animal">
        <img src="img/egg3.png" alt="egg3" id="egg3" class="oeuf">
        <!-- panier -->
        <img src="img/corpslapin.png" alt="" id="corpslapin" class="animal">
        <img src="img/egg4.png" alt="egg4" id="egg4" class="oeuf">
        <!-- fleurs1 -->
        <img src="img/herbebg.png" alt="" id="herbes2" class="decor">
        <img src="img/egg5.png" alt="egg5" id="egg5" class="oeuf">
        <!-- fleurs2 -->
        <img src="img/herbe.png" alt="" id="herbes3" class="decor">
        <img src="img/egg6.png" alt="egg6" id="egg6" class="oeuf">


<div id="confetti" class="confetti">
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
  <div class="confetti-piece"></div>
 </div>

    </div>