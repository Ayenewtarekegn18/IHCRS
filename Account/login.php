<?php
 session_start();
class login {

    function login_hospital(){
      $server="localhost";
      $user="root";
      $pass="";
      $db="ihcrs_database";
      
      $conn=mysqli_connect($server,$user,$pass,$db);
      if(!$conn){
          echo "connection failed";
      }
      
      
      
      
      $email = htmlspecialchars($_POST["login_email"]);
      $password = htmlspecialchars($_POST["login_password"]);
      
      if (empty($email) || empty($password)) {
          return "Email and password are required.";
      }
      
      $sql = "SELECT * FROM hospital WHERE username='$email'";
      $result = mysqli_query($conn, $sql);
      
      if ($result) {
          if (mysqli_num_rows($result) == 1) {
           
  if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
   // header("location: ../services/index.php");
    echo "fff";
  }
  
              while ($row = $result->fetch_assoc()) {
                  if ($password == $row["password"]) {
                    session_start();
                      $_SESSION["email"] = $row["email"];
                      $_SESSION["username"] = $row["username"];
                      $_SESSION["hname"]=$row["hname"];
                      if(isset($_POST["opt"])){
                      $_SESSION["ab"]=$_POST["opt"];}
                     $_SESSION['loggedin']= true;
                    
                     $_POST["login_btn"]=null;
  
                     //echo "Login successful!";
                     header("location: ../docAdmin/index.php");
                    
                      
                    
                  } else {
                     
                   // header("location: acc.php");
                  }
              }
          } else {
            header("location: acc.php?err=");
             // return 'Username does not exist.';
          }
      } else {
      return 'Something went wrong.';
      }
  
    }
    function login_web(){
      echo "hhhhhhhhhhhhhhhh";
      $web= array("abdu"=>"abdu","adane"=>"adane","ebenezer"=>"ebenezer","aduna"=>"aduna","ayenew"=>"ayenew");
         
      $email = htmlspecialchars($_POST["login_email"]);
      $password = htmlspecialchars($_POST["login_password"]);
       $in=0;
      foreach($web as $user => $pass){
        
         if($email == $user && $password == $pass){
          echo "gggg";
        session_start();
       $_SESSION["email"]=$user;
   $_SESSION["username"]=$pass;
   $_SESSION["ab"]=$_POST["opt"];
   header("location: ../allAdmin/index.php");
   break;
        
         }else{
          $in=0;
         header("location: acc.php?err=");
         }
      }

     
  
  
    }

    function login_user(){

      $server="localhost";
      $user="root";
      $pass="";
      $db="ihcrs_database";
      
      $conn=mysqli_connect($server,$user,$pass,$db);
      if(!$conn){
          echo "connection failed";
      }
      
      
      
      
      $email = htmlspecialchars($_POST["login_email"]);
      $password = htmlspecialchars($_POST["login_password"]);
      $sql = "SELECT * FROM patient WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      
      if ($result) {
          if (mysqli_num_rows($result) == 1) {
           
  
  
              while ($row = $result->fetch_assoc()) {
                  if ($password === $row["password"]) {
                   
                      $_SESSION["patient_name"] = $row["full_name"];
                      $_SESSION["patient_id"] = $row["patient_id"];
                     
                      if(isset($_POST["opt"])){
                      $_SESSION["ab"]=$_POST["opt"];}
                     $_SESSION['loggedin']= true;
                    
                     $_POST["login_btn"]=null;
  
                     //echo "Login successful!";
                     header("location: services/index.php");
                    
                      
                    
                  } else {
                     
                   
                  }
              }
          } else {
            header("location: acc.php?err=");
          }
      } else {
      return 'Something went wrong.';
      }
      //Ebenezer write login verification for user here
      echo "write user login code";
    }
    function login_doctor(){

      $server="localhost";
      $user="root";
      $pass="";
      $db="ihcrs_database";
      
      $conn=mysqli_connect($server,$user,$pass,$db);
      if(!$conn){
          echo "connection failed";
      }
      
      
      
      
      $email = htmlspecialchars($_POST["login_email"]);
      $password = htmlspecialchars($_POST["login_password"]);
      $sql = "SELECT * FROM doctors WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      
      if ($result) {
          if (mysqli_num_rows($result) == 1) {
           
  
  
              while ($row = $result->fetch_assoc()) {
                  if ($password === $row["pass"]) {
                   
                      $_SESSION["doctor_name"] = $row["Fname"];
                     
                     
                      if(isset($_POST["opt"])){
                      $_SESSION["ab"]=$_POST["opt"];}
                     $_SESSION['loggedin']= true;
                    
                     $_POST["login_btn"]=null;
  
                     //echo "Login successful!";
                     header("location: ../docHome/index.php");
                    
                      
                    
                  } else {
                     
                   
                  }
              }
          } else {
            header("location: acc.php?err=");
          }
      } else {
      return 'Something went wrong.';
      }
      //Ebenezer write login verification for user here
      echo "write user login code";
    }
  
  }

  
  function  clean($raw){
    $raw=trim($raw);
    $raw=stripslashes($raw);
    $raw=htmlspecialchars($raw);
    return $raw;
    }
  if($_POST["opt"] =="web"){
    $hs1=new login();
   $hs1->login_web();
    
   
    echo "web admin";
    
  }elseif($_POST["opt"] =="hospital"){
   $hs=new login();
   $hs->login_hospital();
    
   
   
   
   
  }elseif($_POST["opt"] =="user"){
    $hs2=new login();
   $hs2->login_user();
     echo "user";

  }elseif($_POST["opt"] =="doctor"){
    $hs3=new login();
    $hs3->login_doctor();
      echo "user";
  }

?>