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
            $valid = false; break;
        } elseif ($count == 1 && $key == "Username") {
            $error = "Ce pseudo est déjà utilisé !";
            $valid = false; break;
        } else {$valid = true;}
    }
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
        <div style = "margin-top:100px">
            <form action = "" method = "post">
                <h1>Inscription</h1>
                Pseudo :<input type="text" name="username" placeholder="Pseudo..." required>
                Adresse Email :<input type="text" name="email" placeholder="Adresse email..." required>
                Mot de passe :<input type="password" name="password" placeholder="Mot de passe..." required>
                Prénom :<input type="text" name="firstname" placeholder="Prénom...">
                Nom :<input type="text" name="lastname" placeholder="Nom...">
                <input type="submit" value="Valider">
                <p style="color: red;"><?php echo $error ?></p>
            </form>
        </div>
    </body>
</html>