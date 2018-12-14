<?php
  session_start();
  require_once('connection.php');
  require_once('twig.php');
  echo $twig->render('header.html',array(
      "title" => "Cart",
      "navbar" => $_SESSION["navbar"]
  ));
  
?>
