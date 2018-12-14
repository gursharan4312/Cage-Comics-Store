<?php
session_start();

require_once("twig.php");

echo $twig->render('header.html',array(
    "title" => "About",
    "navbar" => $_SESSION["navbar"]
));
echo $twig->render('aboutUs.html');
echo $twig->render('footer.html');
 ?>
