<?php

session_start();

$_SESSION["nom"] = htmlentities($_POST["nom"]);
$_SESSION["email"] = htmlentities($_POST["email"]);
$_SESSION["genre"] = htmlentities($_POST["genre"]);
$_SESSION["pays"] = htmlentities($_POST["pays"]);
$_SESSION["sujet_1"] = htmlentities($_POST["sujet_1"]);
$_SESSION["sujet_2"] = htmlentities($_POST["sujet_2"]);
$_SESSION["sujet_3"] = htmlentities($_POST["sujet_3"]);
$_SESSION["msg_area"] = htmlentities($_POST["msg_area"]);

$_SESSION["message"]["nom"] = "*";
$_SESSION["message"]["email"] = "*";
$_SESSION["message"]["msg_area"] = "*";

if ($_SERVER['REQUEST_METHOD']=='POST') {

  $valid = true;

  if(!isset($_SESSION["nom"]) || empty($_SESSION["nom"]))
  {
    $_SESSION["message"]["nom"] = "un nom est requis.";
    $valid = false;
  }
  if(!isset($_SESSION["email"]) || empty($_SESSION["email"]))
  {
    $_SESSION["message"]["email"] = "un e-mail est requis.";
    $valid = false;
  }
  if(!isset($_SESSION["msg_area"]) || empty($_SESSION["msg_area"]))
  {
    $_SESSION["message"]["msg_area"] = "un message est requis.";
    $valid = false;
  }

}

print_r($_SESSION);

 ?>
