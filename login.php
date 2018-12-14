<?php

session_start();
require_once('twig.php');

if(!isset($_SESSION['user'])){
  $_SESSION['user']=array("name"=>"Guest","id"=>1); // variable to hold user information
}else if($_SESSION['user']['id']!=1){
    $_SESSION['user']=array("name"=>"Guest","id"=>1);
    $_SESSION["navbar"] = array(
      array("Home","index.php"),
      array("About","about.php"),
      array("Cart","cart.php"),
      array("Login","login.php")
    );
    echo "<script>alert('You are successfully Logged Out')</script>";
}

echo $twig->render('header.html',array(
    "title" => "Index",
    "navbar" => $_SESSION["navbar"]
));

echo "<div id='formDiv'>";
echo $twig->render('form.html',array(
  "formID" => "form",
  "inputGroups" => array(
    array("name"=>"usernm","id"=>"username","type"=>"text","label"=>"Username:","placeHolder"=>"Enter Username.."),
    array("name"=>"passwd","id"=>"password","type"=>"password","label"=>"Password:","placeHolder"=>"Enter Password..")
  ),
  "buttons" => array(
    array("name"=>"submitBtn","value"=>"Login","type"=>"submit","id"=>"loginBtn"),
    array("name"=>"submitBtn","value"=>"Register/Signup","type"=>"submit","id"=>"signupBtn")
  )
));
echo "</div>";

echo $twig->render('aboutUs.html');
echo $twig->render('footer.html');

?>
