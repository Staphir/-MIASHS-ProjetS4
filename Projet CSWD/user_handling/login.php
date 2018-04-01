<?php
    require_once("config.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
        $myemail = mysqli_real_escape_string($db,$_POST['email']); 
      
        $sql = "SELECT id, username FROM user WHERE email = '$myemail' and password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        $count = mysqli_num_rows($result);
		
        if($count == 1) {
            $_SESSION['login_user'] = $row["username"];
            $_SESSION['user_id'] = $row["id"];
         
            header("location: ../index.php");
        }else {
            $error = "Votre adresse mail ou mot de passe est invalide !";
        }
    } else {$error = "";}
    ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href="connect.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body style="font-family:'Roboto', sans-serif;">
        <div class="top_header">
            <a href="../index.php" class="back_to_main">Accueil</a>
            <header><h1>Storystoire</h1></header>
        </div>	
        <div style = "margin-top:100px">
            <form action = "" method = "post">
                <h1>Connexion</h1>
                Adresse Email :<input type="text" name="email" placeholder="..." required>
                Mot de passe :<input type="password" name="password" placeholder="..." required>
                <input type="submit" value="Connexion">
                Vous n'êtes toujours pas inscrit ? <a href="register.php">S'inscrire</a>
                <p style="color: red;"><?php echo $error ?></p>
            </form>
        </div>
    </body>
</html>