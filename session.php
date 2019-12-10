<?php
   include('Config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $sql = "select login from users where login = '$user_check'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
   }
   else{
      header("location:login.php");
      die();
   }
   $login_session = $row['login'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>