<?php
   require_once('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select Username from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Username'];
   
//    if(!isset($_SESSION['login_user'])){
//       header("location:login.php");
//    }
?>