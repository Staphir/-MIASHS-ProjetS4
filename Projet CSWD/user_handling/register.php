<?php
require_once("config.php");
require_once("session.php");

if (count($_SESSION) != 0) {
    header("location: ../index.php");
}

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
        if ($key == "Email" or $key == "Username") {
            $result = $pdo->prepare("SELECT id FROM user WHERE ".$key." = ?");
            $result->execute(array($value));
            $row = $result->fetchAll(PDO::FETCH_ASSOC); 
            $count = count($row);
        }
        if ($key == "Email" && $count > 0) { // > 0 ou ==1 mais ici on travaille avec un accès direct à la base de données alors bon...
            $error = "Cette adresse mail est déjà utilisée !";
            $newuser["Email"] = "";
            $valid = false; break;
        } elseif ($key == "Username" && $count > 0) {
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
    $query_create = "INSERT INTO user (Id, Username, Password, Email, Firstname, Lastname, Likes, JoinedOn)
            VALUES (NULL, '$username', MD5('$password'), '$email', '$firstname', '$lastname', '0', NOW())";
    $result = $pdo->prepare($query_create);
    $result->execute();

    $query_retrieve = "SELECT id, username FROM user WHERE Email = ? and Password = MD5(?)";
    $result = $pdo->prepare($query_retrieve);
    $result->execute(array($email, $password));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $row[0]['id'];
    $_SESSION['login_user'] = $row[0]['username'];
    header("location: ../index.php");
}
include("../secondary_header.php");
?>

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
<?php include("../footer.php"); ?>