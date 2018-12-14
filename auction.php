<?php

session_start();
require_once('twig.php');
require_once("connection.php");

$auctionComics = array(
  array("id"=>1,"imageURL"=>"views/images/comicsCoverImages/comic1.jpeg","name"=>"firstComic","description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
  array("id"=>2,"imageURL"=>"views/images/comicsCoverImages/comic2.jpg","name"=>"secondComic","description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
  array("id"=>3,"imageURL"=>"views/images/comicsCoverImages/comic3.jpg","name"=>"firstComic","description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.")
);


$comics=array();
$SelectQuery= "SELECT * FROM auctionComics";
  if(mysqli_multi_query($conn, $SelectQuery)){
    do{
      if ($result = mysqli_use_result($conn)) {
          while($row = mysqli_fetch_row($result)) {
              array_push($comics,array("id"=>$row[0],"imageURL"=>$row[5],"name"=>$row[1],"description"=>$row[3]));
          }
        mysqli_free_result($result);
      }
    }while(mysqli_next_result($conn));
  }
  mysqli_close($conn);





echo $twig->render('header.html',array(
    "title" => "Auction Area",
    "navbar" => $_SESSION["navbar"]
));

echo $twig->render('comicsAuction.html',array(
    "comics" => $auctionComics
));

?>
