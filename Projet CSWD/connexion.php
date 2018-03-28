<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <?php require_once("connect_database.php") ?>
    </head>
    <body>

<?php 
$requete = "SELECT Password FROM user WHERE user.Email= ? ";
$reponse = $pdo->prepare($requete);
$reponse->execute($_POST["email"]);

$displayForm = true;
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $pass = $_POST["psw"];
    if ($pass==$reponse) {
        echo "Bienvenue, vous êtes désormais connecté !";
        $displayForm = false;
    }
}
if ($displayForm) {
?>
<div style="margin-top:100px">
    <form action="connexion.php" method="post">
        <h1>Connexion</h1>
        <label>Adresse Email</label>
        <input type="email" name="email" placeholder="Adresse email...">

        <label>Mot de passe</label>
        <input type="password" name="psw" placeholder="Mot de passe...">
    
        <input type="submit" value="Submit">
  </form>
</div>
<?php } ?>
    </body>
</html>

