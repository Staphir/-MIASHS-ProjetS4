<?php
require_once("config.php");
session_start();
$valid = false; $error = "";

if (isset($_POST) && (!empty($_POST))) {
    $newuser = array();
    $newuser["Password"] = $_POST["password"];
    $newuser["Email"] = $_POST["email"];
    $newuser["Username"] = $_POST["username"];

    if (isset($_POST["firstname"])) {
        $newuser["Firstname"] = $_POST["firstname"];
    } else {$newuser["Firstname"] = "";}
    if (isset($_POST["lastname"])) {
        $newuser["Lastname"] = $_POST["lastname"];
    } else {$newuser["Lastname"] = "";}

    foreach ($newuser as $key => $value) {
        $sql = "SELECT id FROM user WHERE $key = '$value'";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);

        if ($count == 1 && $key == "Email") {
            $error = "Cette adresse mail est déjà utilisée !";
            $newuser["Email"] = "";
            $valid = false; break;
        } elseif ($count == 1 && $key == "Username") {
            $error = "Ce pseudo est déjà utilisé !";
            $newuser["Username"] = "";
            $valid = false; break;
        } elseif ($_POST["password"] != $_POST["c_password"]) {
            $error = "Les mots de passe ne correspondent pas !";
            $valid = false; break;
        } else {$valid = true;}
    }   
} else {
    $newuser = array();
    $newuser["Password"] = "";
    $newuser["Email"] = "";
    $newuser["Username"] = "";
}
if ($valid) {
    $username = $newuser['Username']; $password = $newuser['Password'];
    $email = $newuser['Email']; $firstname = $newuser['Firstname'];
    $lastname = $newuser['Lastname'];
    $sql_create = "INSERT INTO user (Id, Username, Password, Email, Firstname, Lastname, Likes)
            VALUES (NULL, '$username', '$password', '$email', '$firstname', '$lastname', '0')";
    $result = mysqli_query($db,$sql_create);

    $sql_retrieve = "SELECT id, username FROM user WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($db,$sql_retrieve); $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['login_user'] = $row['username'];
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>S'inscrire</title>
        <link href="connect.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body style="font-family:'Roboto', sans-serif;">	
        <div class="top_header">
            <a class="back_to_main" href="../index.php">Accueil</a>
            <header><h1>Storystoire</h1></header>
        </div>
        <div style = "margin-top:100px">
            <form action = "" method = "post">
                <h1>Inscription</h1>
                * Nom d'utilisateur :<input type="text" name="username" placeholder="..." required <?php echo 'value='.$newuser['Username']; ?>>
                * Adresse Email :<input type="email" name="email" placeholder="..." required <?php echo "value=".$newuser["Email"]; ?>>
                * Mot de passe :<input type="password" name="password" placeholder="..." required>
                * Confirmation de mot de passe :<input type="password" name="c_password" placeholder="..." required>
                <hr style="margin:30px;">
                Prénom :<input type="text" name="firstname" placeholder="...">
                Nom :<input type="text" name="lastname" placeholder="...">
                <p style="font-size:11px;">Les champs précédés d'une étoile * sont indispensables.</p><input type="submit" value="Valider">
                <p style="color: red;"><?php echo $error ?></p>
            </form>
        </div>
    </body>
</html>