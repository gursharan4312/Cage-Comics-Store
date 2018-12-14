<?php
 session_start();
 require_once("connection.php");
 require_once('twig.php');
 echo $twig->render('header.html',array(
     "title" => "Cart",
     "navbar" => $_SESSION["navbar"]
 ));
    if(isset($_GET["id"])){
      $SelectQuery= "SELECT * FROM comics where id=".$_GET["id"];
        if(mysqli_multi_query($conn, $SelectQuery)){
          do{
            if ($result = mysqli_use_result($conn)) {
                while($row = mysqli_fetch_row($result)) {
                    $comic=array("id"=>$row[0],"imageURL"=>$row[5],"name"=>$row[1],"description"=>$row[3],"author"=>$row[2],"price"=>$row[4]);
                }
              mysqli_free_result($result);
            }
          }while(mysqli_next_result($conn));
        }
        mysqli_close($conn);

// rendering web content
      echo $twig->render('comic-detail.html',array(
        "comic" => $comic
      ));
    }
    echo $twig->render('aboutUs.html');
    echo $twig->render('footer.html');
 ?>
