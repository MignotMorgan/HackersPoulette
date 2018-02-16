<?php

session_start();
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
$_SESSION["sujet_1"] = htmlentities($_POST["sujet_1"]);
$_SESSION["sujet_2"] = htmlentities($_POST["sujet_2"]);
$_SESSION["sujet_3"] = htmlentities($_POST["sujet_3"]);
$_SESSION["msg_area"] = htmlentities($_POST["msg_area"]);
//initialisation des messages d'erreur.
$_SESSION["message"]["nom"] = "*";
$_SESSION["message"]["email"] = "*";
$_SESSION["message"]["msg_area"] = "*";

$_SESSION["valid"]["color"]="#000000";
$_SESSION["valid"]["message"]="";

//vérification des valeurs après la Sanitisation
if ($result != null && $result != FALSE && $_SERVER['REQUEST_METHOD']=='POST')
{
  $valid = true;

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
    $sujet = "Formulaire de contact";
    $contenu = $_SESSION["msg_area"];
    $headers = "From: " .$_SESSION["nom"] ."<" .$_SESSION["email"]."> \r\n";
    $headers .= "Reply-To: " .$_SESSION["email"] ."\r\n";

    // envoi de l'email
    if( mail($destinataire, $sujet, $contenu, $headers) )
    {
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

print_r($_SESSION);

  /*fonction qui inclut les sous-titres de validation de l'email*/
  function message_valid($msg_valid, $color)
  {
    if($msg_valid != "")
      return '<h3 style="color:'.$color.'" >'.$msg_valid.'</h3>';
  }

 ?>
