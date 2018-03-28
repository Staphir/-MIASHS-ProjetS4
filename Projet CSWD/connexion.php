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

