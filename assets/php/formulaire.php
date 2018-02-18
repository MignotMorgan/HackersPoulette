<?php

/*Sanitisation*/
$options = array(
  'civil'     => FILTER_SANITIZE_STRING
  ,'nom'      => FILTER_SANITIZE_STRING
  ,'email'    => FILTER_VALIDATE_EMAIL
  ,'pays'     => FILTER_SANITIZE_STRING
  ,'msg_area' => FILTER_SANITIZE_STRING
  ,'sujet_1'  => FILTER_SANITIZE_STRING
  ,'sujet_2'  => FILTER_SANITIZE_STRING
  ,'sujet_3'  => FILTER_SANITIZE_STRING
);
$result = filter_input_array(INPUT_POST, $options);

//récupération des variable POST dans la SESSION
$_SESSION["civil"] = htmlentities($_POST["civil"]);
$_SESSION["nom"] = htmlentities($_POST["nom"]);
$_SESSION["email"] = htmlentities($_POST["email"]);
$_SESSION["pays"] = htmlentities($_POST["pays"]);
$_SESSION["msg_area"] = htmlentities($_POST["msg_area"]);
$_SESSION["sav"] = htmlentities($_POST["sav"]);
$_SESSION["livraison"] = htmlentities($_POST["livraison"]);
$_SESSION["autre"] = htmlentities($_POST["autre"]);
$_SESSION["copie"] = htmlentities($_POST["copie"]);
//initialisation des messages d'erreur.
$_SESSION["message"]["nom"] = "*";
$_SESSION["message"]["email"] = "*";
$_SESSION["message"]["msg_area"] = "*";
//initialisation du message du sous-titre de validation.
$_SESSION["valid"]["color"]="#000000";
$_SESSION["valid"]["message"]="";

//vérification des valeurs après la Sanitisation
if ($result != null && $result != FALSE && $_SERVER['REQUEST_METHOD']=='POST')
{
  $valid = true;

  //vérification de l'input caché.(ce champ doit être vide.)
  if(!empty($_POST["address"]))
  {
    $valid = false;
    vider_session();//vide la SESSION à l'aide d'une fonction.
  }

  //vérification du nom
  if(!isset($_SESSION["nom"]) || empty($_SESSION["nom"]))
  {
    $_SESSION["message"]["nom"] = "un nom est requis.";
    $valid = false;
  }

  //vérification de l'e-mail
  if(!isset($_SESSION["email"]) || empty($_SESSION["email"]))
  {
    $_SESSION["message"]["email"] = "un e-mail est requis.";
    $valid = false;
  }
  //vérification du format de l'e-mail
  if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL))
  {
    $_SESSION["message"]["email"] = "votre e-mail n'a pas le bon format.";
    $valid = false;
  }

  //vérification du message
  if(!isset($_SESSION["msg_area"]) || empty($_SESSION["msg_area"]))
  {
    $_SESSION["message"]["msg_area"] = "un message est requis.";
    $valid = false;
  }

  //Le formulaire est valide
  //mise en forme de l'email
  if($valid)
  {
    $destinataire = "MignotMorgan@gmail.com";
    $titre = "Message de ".$_SESSION["civil"]." ".$_SESSION["nom"].".";

    $headers = "From: " .$_SESSION["nom"] ."<" .$_SESSION["email"]."> \r\n";
    $headers .= "Reply-To: " .$_SESSION["email"] ."\r\n";
    $headers .= "MIME-Version: 1.0 \r\n";
    $headers .= "Content-Type: text/plain \r\n";

    /*Sujets selectionner*/
    $contenu = "Sujets : ";
    $sujet_autre=true;//verifie si un sujet à été selectionner.
    if($_SESSION["sav"] == "sav")
    {
      $sujet_autre=false;
      $contenu .= "Service après vente. ";
    }
    if($_SESSION["livraison"] == "livraison")
    {
      $sujet_autre=false;
      $contenu .= "Livraison. ";
    }
    if($sujet_autre || $_SESSION["autre"] == "autre")
    {
      $contenu .= "Autres.";
    }
    $contenu .= "\r\n";
    $contenu .= $_SESSION["msg_area"];

    // envoi de l'email
    if( mail($destinataire, $titre, $contenu, $headers) )
    {
      /*Demande d'une copie de l'email*/
      if($_SESSION["copie"] == "copie")
        mail($_SESSION["email"], "Copie : ".$titre, $contenu, $headers);
      /*vide la SESSION à l'aide d'une fonction.*/
      vider_session();
      $_SESSION["valid"]["color"]="#00FF00";
      $_SESSION["valid"]["message"]="votre message à été envoyé.";
    }
    else
    {
      $_SESSION["valid"]["color"]="#FF0000";
      $_SESSION["valid"]["message"]="Une erreur c'est produite pendant l'envoi.";
    }
  }
  else
  {
    $_SESSION["valid"]["color"]="#FF0000";
    $_SESSION["valid"]["message"]="Le message n'a pas pu être envoyé.";
  }
}

  /*fonction qui inclut les sous-titres de validation de l'email*/
  function message_valid($msg_valid, $color)
  {
    if($msg_valid != "")
      return '<h3 style="color:'.$color.'" >'.$msg_valid.'</h3>';
  }
  /*fonction qui vide la SESSION*/
  function vider_session()
  {
    session_unset();
    //initialisation des variables.
    $_SESSION["civil"] = "";
    $_SESSION["nom"] = "";
    $_SESSION["email"] = "";
    $_SESSION["pays"] = "Belgique";
    $_SESSION["msg_area"] = "";
    $_SESSION["sav"] = "";
    $_SESSION["livraison"] = "";
    $_SESSION["autre"] = "";
    $_SESSION["copie"] = "";
    //initialisation des messages d'erreur.
    $_SESSION["message"]["nom"] = "*";
    $_SESSION["message"]["email"] = "*";
    $_SESSION["message"]["msg_area"] = "*";
  }

 ?>
