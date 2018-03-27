<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href="css/formulaire.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
<?php
$displayForm = true;
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    //echo "Votre email est : ".$email;
    if ($email=="mail@monmail.fr" && $pass=="f2aL+RSw") {
        echo "Bienvenue, vous êtes désormais connecté !";
        $displayForm = false;
    }
}
if ($displayForm) {
?>
    <h2 style="font-size : 25px">Connexion</h2>
        <form action="connexion.php" method="post">
            <fieldset>
                <label class="email">Adresse email :</label><br/><input type="email" name="email"/><br/>
                <label class="nombre">Mot de passe :</label><br/><input type="password" name="pass"/><br/>
                <input type="checkbox" name="rememberme"/><label>Se souvenir de moi</label><br/>
                <input type="submit" class="submit" value="Envoyer"/>
            </fieldset>
        </form>
<?php } ?>
    </body>
</html>

=======
<!-- <!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href="css/formulaire.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
<?php
$displayForm = true;
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    //echo "Votre email est : ".$email;
    if ($email=="mail@monmail.fr" && $pass=="f2aL+RSw") {
        echo "Bienvenue, vous êtes désormais connecté !";
        $displayForm = false;
    }
}
if ($displayForm) {
?>
    <h2 style="font-size : 25px">Connexion</h2>
        <form action="connexion.php" method="post">
            <fieldset>
                <label class="email">Adresse email :</label><br/><input type="email" name="email"/><br/>
                <label class="nombre">Mot de passe :</label><br/><input type="password" name="pass"/><br/>
                <input type="checkbox" name="rememberme"/><label>Se souvenir de moi</label><br/>
                <input type="submit" class="submit" value="Envoyer"/>
            </fieldset>
        </form>
<?php } ?>
    </body>
</html> -->

<form action="action_page.php">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form> 
>>>>>>> d3a92b3a5d55def4bd45b7dc2dba729edb19e845
