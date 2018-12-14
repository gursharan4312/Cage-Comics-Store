<?php
require_once("connection.php");
// installing twig
require_once("twig.php");

  session_start();
  if(!isset($_SESSION['cartItems'])){
      $_SESSION['cartItems']=array(); // session variable to save ids of comics added to cart
  }
  if(!isset($_SESSION['user'])){
    $_SESSION['user']=array("name"=>"Guest","id"=>1); // variable to hold user information
  }

    // session navbar that holds userinformation and navigation menus
    $_SESSION["navbar"] = array(
      array("Home","index.php"),
      array("About","about.php"),
      // array("Auction Area","auction.php"),
      array("Cart","cart.php")
    );

// getting comic details from database
    $comics=array();
    $SelectQuery= "SELECT * FROM comics";
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

// checking if user is logged in
    if($_SESSION['user']["id"]==1){
      array_push($_SESSION["navbar"],array("Login","login.php"));
    }else{
      array_push($_SESSION["navbar"],array("Sign out","login.php"));
    }

// rendering webpage
  echo $twig->render('header.html',array(
      "title" => "Index",
      "navbar" => $_SESSION["navbar"]
  ));
  echo $twig->render('hero.html');
  echo $twig->render('comics.html',array(
      "comics" => $comics
  ));
  echo $twig->render('aboutUs.html');
  echo $twig->render('footer.html');
?>
