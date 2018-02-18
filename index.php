<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire de contact.</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/menu.css">
    <link rel="stylesheet" href="./assets/fonts/bellota-fontfacekit/web fonts/bellota_bold_macroman/stylesheet.css" type="text/css" charset="utf-8" />
  </head>
  <body>
    <?php include("./assets/php/formulaire.php"); ?>
    <section class="section--hackers">
      <header class="section-header--hackers">
          <h1 >Contactez-nous.</h1>
          <?php if($_SESSION["valid"]["message"] != "")echo message_valid($_SESSION["valid"]["message"], $_SESSION["valid"]["color"]); ?>
          <hr>
      </header>
      <main class="section-main--hackers">
        <img class="logo--hackers" src="./assets/images/hackers-poulette-logo.png" alt="">
        <form class="form--hackers" action="index.php" method="post">
          <fieldset class="fieldset--round">
            <legend>Information</legend>

              <input class="address" type="text" name="address" value="">

              <fieldset>
                <legend>Civilité</legend>
                <input type="radio" name="civil" value="Mr" <?php if(empty($_SESSION["civil"]) || $_SESSION["civil"]=="Mr")echo "checked"; ?>>Mr
                <input type="radio" name="civil" value="Mme" <?php if($_SESSION["civil"] == "Mme")echo "checked='checked'"; ?>>Mme
                <input type="radio" name="civil" value="Mlle" <?php if($_SESSION["civil"] == "Mlle")echo "checked='checked'"; ?>>Mlle
              </fieldset>

              <label class="lbl--block" for="nom">Nom :</label>
              <input type="text" name="nom" value='<?php echo $_SESSION["nom"]; ?>' placeholder="votre nom." required>
              <label class="lbl--alert" for="nom" nom="nom_alert"><?php echo $_SESSION["message"]["nom"]; ?></label>

              <label class="lbl--block" for="email">Email :</label>
              <input type="email" name="email" value='<?php echo $_SESSION["email"]; ?>' placeholder="votre e-mail" required>
              <label class="lbl--alert" for="email" nom="email_alert"><?php echo $_SESSION["message"]["email"]; ?></label>

              <!-- Liste de selection des pays cf: "./assets/php/selectpays.php" -->
              <?php include("./assets/php/selectpays.php"); echo selectpays($_SESSION["pays"]); ?>

          </fieldset>
          <fieldset class="fieldset--round">
            <legend>Message</legend>
              <!-- Barre de navigation des sujets cf: "./assets/css/menu.css" -->
              <nav class="nav--sujets">
                <a href="#">Sujets</a>
                <label class="lbl--alert" for="msg_area" nom="msg_area_alert"><?php echo $_SESSION["message"]["msg_area"]; ?></label>
                <ul>
                  <li>
                    <input type="checkbox" name="sav" id="sav" value="sav" <?php if($_SESSION["sav"]=="sav")echo "checked"; ?>>
                    <label for="sav">Service après vente</label>
                  </li>
                  <li>
                    <input type="checkbox" name="livraison" id="livraison" value="livraison"<?php if($_SESSION["livraison"]=="livraison")echo "checked"; ?>>
                    <label for="livraison">Livraison d'une commande</label>
                  </li>
                  <li>
                    <input type="checkbox" name="autre" id="autre" value="autre"<?php if($_SESSION["autre"]=="autre")echo "checked"; ?>>
                    <label for="autre">Autres...</label>
                  </li>
                  <hr>
                  <li>
                    <input type="checkbox" name="copie" id="copie" value="copie"<?php if($_SESSION["copie"]=="copie")echo "checked"; ?>>
                    <label for="copie">Je désire une copie de l'e-mail.</label>
                  </li>
                </ul>
              </nav>
              <textarea class="fieldset--message--area" name="msg_area" rows="10" cols="80" placeholder="écrivez votre message ici." required><?php echo $_SESSION["msg_area"]; ?></textarea>
          </fieldset>
          <input class="btn--envoyer" type="submit" name="btn_envoyer" value="Envoyer">
        </form>
      </main>
      <footer class="section-footer--hackers">
        <hr>
        <label class="footer-lbl lbl--alert" for="">* champ obligatoire.</label>
        <a href="https://www.raspberrypi.org/"><img class="Raspberry-Pi-Logo" src="./assets/images/Powered-by-Raspberry-Pi-Logo.png" alt="https://www.raspberrypi.org/"></a>
        <a href="https://www.becode.org/"><img class="Becode-Logo" src="https://www.becode.org/img/socialshare.png" alt="https://www.becode.org/"></a><br/>
        <span class="span--copyright">©copyright Becode 2018.</span>
      </footer>
    </section>
  </body>
</html>
