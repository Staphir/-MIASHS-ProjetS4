<?php
require_once("config.php");
require_once("session.php");

if (count($_SESSION) != 0) {
    header("location: ../index.php");
}
$error = ""; $menu["title"] = "Connexion";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $mypassword = $_POST['password'];
    $myemail = $_POST['email'];
    
    $query = "SELECT id, username, verified, email FROM user WHERE Email = ? and Password = MD5(?)";
    $result=$pdo->prepare($query);
    $result->execute(array($myemail, $mypassword));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);

    if ($count == 1 && $row[0]["verified"]) {
        $_SESSION['login_user'] = $row[0]["username"];
        $_SESSION['user_id'] = $row[0]["id"];
        $_SESSION["user_email"] = $row[0]["email"];
        $_SESSION["user_verified"] = $row[0]["verified"];

        header("location: ../index.php");
    } elseif (!$row[0]["verified"]) {
        header("location: register_confirmation.php?reg=0");
    } else {
        $error = "Votre adresse mail ou mot de passe est invalide !";
    }
}
include("../secondary_header.php");
?>
<form action = "" method = "post">
    <h1>Connexion</h1>
    Adresse Email :<input type="email" name="email" placeholder="..." required>
    Mot de passe :<input type="password" name="password" placeholder="..." required>
    <input type="submit" value="Connexion">
    Vous n'êtes toujours pas inscrit ? <a href="register.php">S'inscrire</a>
    <p style="color: red;"><?php echo $error ?></p>
</form>
<?php include("../footer.php"); ?>