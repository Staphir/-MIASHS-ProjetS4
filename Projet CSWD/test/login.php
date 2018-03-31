<?php
   require_once("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      print_r($row);
      $active = $row['id']; 
      $count = mysqli_num_rows($result);

      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['myusername'];
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   } else {$error = "";}
   ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href="connect.css" rel="stylesheet" type="text/css" media="all"/>
        <?php require_once("config.php") ?>
    </head>
    <body style="font-family:'Roboto', sans-serif;">	
        <div style = "margin-top:100px">
            <form action = "" method = "post">
                <h1>Connexion</h1>
                Adresse Email :<input type="text" name="username" placeholder="Adresse email.." required>
                Mot de passe :<input type="password" name="password" placeholder="Mot de passe.." required>
                <input type="submit" value="Valider">
                <p style="color: red;"><?php echo $error ?></p>
            </form>
        </div>
    </body>
</html>