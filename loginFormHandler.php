<?php
  session_start();
  require_once("connection.php");
  require_once("twig.php");

if($_POST["submitBtn"]=="Login"){
  // displaying any  error related to form
  if(empty($_POST['usernm'])&&empty($_POST['passwd'])){
      echo json_encode(["empty","username","password"]);
  }else if(empty($_POST['usernm'])){
        echo json_encode(["empty","username"]);
  }else if(empty($_POST['passwd'])){
    echo json_encode(["empty","password"]);
  }else{ // checking login information if no error
    $user=array();
     $userFound=false;
     $selectQuery= "SELECT * FROM users where username='".$_POST["usernm"]."';";

       if(mysqli_multi_query($conn, $selectQuery)){
         do{
           if ($result = mysqli_use_result($conn)) {
               while($row = mysqli_fetch_row($result)) {
                 if(strcmp($_POST['passwd'],$row[5])==0){
                   $user=array("id"=>$row[0],"name"=>$row[1]);
                   $userFound=true;
                 }
               }
             mysqli_free_result($result);
           }
         }while(mysqli_next_result($conn));
       }

       // changing user
       if($userFound){
         $_SESSION['user']=$user;
         echo json_encode(["sucess"]);
       }else{
         echo json_encode(["loginerr"]);
       }

     } // end-else
}else if($_POST["submitBtn"]=="Register/Signup"){
  echo $twig->render('form.html',array(
          "formID" => "form",
          "inputGroups" => array(
            array("name"=>"name","id"=>"name","type"=>"text","label"=>"Full Name:","placeHolder"=>"Enter Name here.."),
            array("name"=>"email","id"=>"email","type"=>"email","label"=>"Email address:","placeHolder"=>"sample@emample.com"),
            array("name"=>"username","id"=>"username","type"=>"text","label"=>"Choose Username:","placeHolder"=>"sampleUser123"),
            array("name"=>"phone","id"=>"phone","type"=>"text","label"=>"Phone Number:","placeHolder"=>"+1(604)xxx-xxxx"),
            array("name"=>"passwrd","id"=>"passwrd","type"=>"password","label"=>"Password:","placeHolder"=>"********"),
            array("name"=>"passwrd2","id"=>"passwrd2","type"=>"password","label"=>"Re-Enter password:","placeHolder"=>"********")
          ),
          "buttons" => array(
            array("name"=>"submitBtn","value"=>"Signup","type"=>"submit","id"=>"signupUser")
          )
        ));
}else if($_POST["submitBtn"]=="Signup"){
  // $userFound=false;
  $data = array($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['username'],$_POST['passwrd'],$_POST['passwrd2']);
  $empty=array("empty");
  if(empty($data[0])){ array_push($empty,"name"); }
  if(empty($data[1])){ array_push($empty,"email"); }
  if(empty($data[3])){ array_push($empty,"username"); }
  if(empty($data[4])){ array_push($empty,"passwrd"); }
  if(empty($data[5])){ array_push($empty,"passwrd2"); }
  if(sizeof($empty)==1){
      if($data[4]==$data[5]){
        $selectQuery= "SELECT * FROM users where username='".$data[3]."';";
       $insertQuery= "INSERT INTO users(Name,Email,phone,username,password)  VALUES('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."');";
       mysqli_multi_query($conn, $insertQuery);
         echo json_encode(["sucess"]);
      }else{
          echo json_encode(["noMatch"]);
      }
  }else{
    echo json_encode($empty);
  }
}

mysqli_close($conn);
 ?>
