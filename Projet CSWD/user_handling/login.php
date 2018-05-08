<?php
$dir1 = "../";
$error = ""; $menu["title"] = "Connexion";
include("../main_header.php");

if (count($_SESSION) != 0) {
    header("location: ../index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $mypassword = $_POST['password'];
    $myemail = $_POST['email'];
    $query = 'SELECT id, username, verified, email, password FROM user WHERE email = ? ;';
    $result=$pdo->prepare($query);
    $result->execute(array($myemail));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);

    if ($count == 1 && password_verify(trim($mypassword), $row[0]["password"]) && $row[0]["verified"]) {
        $_SESSION['login_user'] = $row[0]["username"];
        $_SESSION['user_id'] = $row[0]["id"];
        $_SESSION["user_email"] = $row[0]["email"];
        $_SESSION["user_verified"] = $row[0]["verified"];

        header("location: ".$_SESSION["current_url"]);
    } elseif ($count == 1 && !$row[0]["verified"]) {
        header("location: register_confirmation.php?reg=0");
    } else {
        $error = "Votre adresse mail ou mot de passe est invalide !";
    }
}

?>
<section>
    <article class="card">
        <div>
            <form action="" method="post">
                <h2>Connexion</h2><hr>
                <p>Le système de mots de passe ayant changé le 03/05/2018, vos mots de passe datant d'avant cette date ne sont plus valides.</p>
                <a href="update_password.php" class="pwdch">Mettre à jour le mot de passe</a>
                <p>Adresse Email :</p><input type="email" name="email" placeholder="..." required>
                <p>Mot de passe :</p><input type="password" name="password" placeholder="..." required>
                Rester connecter
                <input type="submit" style="margin-top:20px" value="Connexion">
                Vous n'êtes toujours pas inscrit ? <a href="register.php">S'inscrire</a>
                <p  class="alert"><?php echo $error ?></p>
            </form>
        </div>
    </article>
</section>
    
<?php include("../footer.php"); ?>