<?php
session_start();
require_once("connection.php");
require_once('twig.php');

if(!isset($_SESSION['cartItems'])){
    $_SESSION['cartItems']=array(); // session variable to save ids of comics added to cart
}

  if(isset($_POST["id"])){
    $alreadyInCart=false;
    for($i=0;$i<sizeof($_SESSION['cartItems']);$i++){
      if($_POST["id"]==$_SESSION['cartItems'][$i]['id']){
        $_SESSION['cartItems'][$i]['quantity']++;
        $alreadyInCart=true;
      }
    }
    if(!$alreadyInCart){
      array_push($_SESSION['cartItems'],array('id'=>$_POST['id'],'quantity'=>1));
    }
  }

$cartItems=array();
  for($i=0;$i<sizeof($_SESSION['cartItems']);$i++){
  $SelectQuery= "SELECT * FROM comics where id='".$_SESSION['cartItems'][$i]['id']."'";
    if(mysqli_multi_query($conn, $SelectQuery)){
      do{
        if ($result = mysqli_use_result($conn)) {
            while($row = mysqli_fetch_row($result)) {
                $totalPriceOfComic = $_SESSION['cartItems'][$i]['quantity']*$row[4];
                array_push($cartItems,array("name"=>$row[1],"author"=>$row[2],"price"=>$row[4],'quantity'=>$_SESSION['cartItems'][$i]['quantity'],"totalPrice"=>$totalPriceOfComic));

            }
          mysqli_free_result($result);
        }
      }while(mysqli_next_result($conn));
    }
}
mysqli_close($conn);

  echo $twig->render('header.html',array(
      "title" => "Cart",
      "navbar" => $_SESSION["navbar"]
  ));
  echo $twig->render('table.html',array(
    "heading" => array('Name','Author','Price','Quantity','Total Price'),
    "data" => $cartItems
  ));
 ?>
