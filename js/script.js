$(document).ready(()=>{

  $(".addToCart").click(function(){
    $.ajax({
      method:"post",
      url:"cart.php",
      data:{id:$(this).val()}
    }).done(()=>{
      $(this).html("Added to Cart");
    })
  });

  // getting value of button pressed
  var btnval;
  $(document).on("click",".formBtn",function(){
    btnval=$(this).val();
  })

$(document).on("submit","#form",function(e){
  e.preventDefault();
  var values=$("#form").serialize();
  values += "&submitBtn="+btnval;
  $.ajax({
      method:"post",
      url:"loginFormHandler.php",
      data:values
    }).done(function(result){
      if(btnval=="Login"){
        var data = jQuery.parseJSON(result);
         if(data[0]=="empty"){ // showing error if any
          $( "#error" ).html( "<h2 style='color:red;'>Please fill all red boxes</h2>" );
          data.forEach((entry)=>{
            $("#"+entry).addClass("red-inputGroup");
            })
        }else if(data[0]=="sucess"){ // redirecting to index if sucessfully logged in
          window.location.replace("index.php");
        }else if(data[0]=="loginerr"){
          $( "#error" ).html( "<h2 style='color:red;'>Wrong username/password</h2>" );
          // $("#passwords").val()="";
        }
      }else if(btnval=="Register/Signup"){
        $("#formDiv").html(result);
      }else if (btnval=="Signup") {
        var data = jQuery.parseJSON(result);
        if(data[0]=="empty"){ // showing error if any
          $( "#error" ).html( "<h2 style='color:red;'>Please fill all red boxes</h2>" );
         data.forEach((entry)=>{
           $("#"+entry).addClass("red-inputGroup");
         });
         }else if(data[0]=="sucess"){ // redirecting to index if sucessfully logged in
           alert("Sucessfully signed in");
           window.location.replace("index.php");
       }else if(data[0]=="noMatch"){ // redirecting to index if sucessfully logged in
         $( "#error" ).html( "<h2 style='color:red;'>Please enter correct password</h2>" );
         $("#passwrd").addClass("red-inputGroup");
         $("#passwrd2").addClass("red-inputGroup");
        }
      }
    })
})
}); // end document.ready
