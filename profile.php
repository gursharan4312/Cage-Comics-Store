<?php
require_once("connection.php");
// installing twig
require_once("twig.php");

session_start();
if(!isset($_SESSION['cartItems'])){
    $_SESSION['cartItems']=array(); // session variable to save ids of comics added to cart
}
if(!isset($_SESSION['user'])){
  $_SESSION['user']=array("name"=>"Guest","id"=>1,"email"=>"guest@cageComics.com","phone"=>"0000000000"); // variable to hold user information
}

 echo $twig->render('header.html',array(
     "title" => "Index",
     "navbar" => $_SESSION["navbar"]
 ));
 echo $twig->render('profile.html',array(
     "user" => $_SESSION["user"]
 ));
 echo $twig->render('footer.html');
?>
