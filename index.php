<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire de contact</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/menu.css">
    <link rel="stylesheet" href="./assets/fonts/bellota-fontfacekit/web fonts/bellota_regular_macroman/stylesheet.css" type="text/css" charset="utf-8" />
  </head>
  <body>
    <?php include("./assets/php/formulaire.php"); ?>
    <section class="section--hackers">
      <header class="section-header--hackers">
          <h1 >Formulaire de contact.</h1>
          <hr>
      </header>
      <main class="section-main--hackers">

        <form class="form--hackers" action="index.php" method="post">
            <img class="logo--hackers" src="./assets/images/hackers-poulette-logo.png" alt="">
          <fieldset class="fieldset--round form-fieldset--info">
            <legend>Information</legend>

              <label class="lbl--block" for="nom">Nom :</label>
              <input type="text" name="nom" value=<?php echo $_SESSION["nom"]; ?> placeholder="votre nom." required>
              <label class="lbl--alert" for="nom" nom="nom_alert">*</label>

              <label class="lbl--block" for="email">Email :</label>
              <input type="email" name="email" value=<?php echo $_SESSION["email"]; ?> placeholder="votre e-mail" required>
              <label class="lbl--alert" for="email" nom="email_alert">*</label>

              <fieldset>
                <legend>Genre</legend>
                <input type="radio" name="genre" value="homme" <?php if(!$_SESSION["genre"] || $_SESSION["genre"]="homme")echo "checked"; ?>>Homme
                <input type="radio" name="genre" value="femme" <?php if($_SESSION["genre"] == "femme")echo "checked"; ?>>Femme
              </fieldset>

              <?php include("./assets/php/selectpays.php"); echo selectpays($_SESSION["pays"]); ?>

          </fieldset>
          <fieldset class="fieldset--round form-fieldset--message">
            <legend>Message</legend>
              <nav class="nav--sujets">
                <a href="#">Sujets</a>
                <label class="lbl--alert" for="msg_area" nom="msg_area_alert">*</label>
                <ul>
                  <li>
                    <input type="checkbox" name="sujet_1" id="sujet_1" value="sujet_1">
                    <label for="sujet_1">sujet 1</label>
                  </li>
                  <li>
                    <input type="checkbox" name="sujet_2" id="sujet_2" value="sujet_2">
                    <label for="sujet_2">sujet 2</label>
                  </li>
                  <li>
                    <input type="checkbox" name="sujet_3" id="sujet_3" value="sujet_3">
                    <label for="sujet_3">sujet 3</label>
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
        <label class="lbl--alert" for="">* champ obligatoire.</label>
        <span class="span--copyright">©copyright Becode 2018.</span>
      </footer>
    </section>
  </body>
</html>
