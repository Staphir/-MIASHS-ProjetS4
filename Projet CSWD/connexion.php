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

$displayForm = true;
if (isset($_POST["email"])) {
    $query = "SELECT Username, Password, Email, Firstname, Lastname FROM user WHERE user.Email= ? ";
    $answer = $pdo->prepare($query);
    $answer->execute(array($_POST["email"]));
    $data = $answer->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($data)) {
        $pass = $_POST["psw"];
        if ($pass==$data[0]["Password"]) {
            header('Location: index.php');
            exit();
        }
    }
}
if ($displayForm) {
?>
        <div style="margin-top:100px">
            <form action="connexion.php" method="post">
                <h1>Connexion</h1>
                <?php 
                if (isset($_POST["email"])) {
                    $default_value = !empty($_POST["email"])?$_POST["email"]:'';
                    $value = "value = ".$default_value;
                } else {$value = '';}
                ?>
                Adresse Email :<input <?php echo $value ?> type="email" name="email" placeholder="Adresse email.." required>
                Mot de passe :<input type="password" name="psw" placeholder="Mot de passe.." required>
                <input type="submit" value="Valider">
        </form>
        </div>
<?php } ?>
    </body>
</html>

