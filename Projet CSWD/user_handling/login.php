<?php
$dir1 = "../";
$error = ""; $menu["title"] = "Connexion";
include("../main_header.php");

if (isset($_SESSION) && count($_SESSION) != 0) {
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

        if (!empty($_POST['stayConnected'])) {

            $salt = 'PANOFERALT';
            $identifier = md5($salt . md5($_SESSION['login_user'] . $salt));
            $token = md5(uniqid(rand(), TRUE));

            $query = "UPDATE user SET token = ? WHERE id = ? ;";
            $result=$pdo->prepare($query);
            $result->execute(array($token, $_SESSION['user_id']));

            setcookie('id', $_SESSION['user_id'], time()+3600*24*30, $cookie_path);
            setcookie('token', $token, time()+3600*24*30, $cookie_path);        
        } else {
            setcookie('id', '', time()-3600);
            setcookie('token', '', time()-3600);     
        }

        header("location: ../index.php");
    } elseif ($count == 1 && !$row[0]["verified"]) {
        header("location: register_confirmation.php?reg=0");
    } else {
        $error = "Votre adresse mail ou mot de passe est invalide !";
    }
} elseif (!empty($_COOKIE['id'])) {
    $result = $pdo->prepare("SELECT * FROM user WHERE id = ? AND token = ? ;");
    $result->execute(array($_COOKIE['id'], $_COOKIE['token']));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if (count($row)) {
        $salt = 'PANOFERALT';
        $identifier = md5($salt . md5($_SESSION['login_user'] . $salt));
        $token = md5(uniqid(rand(), TRUE));

        $result=$pdo->prepare("UPDATE user SET token = ? WHERE id = ? ;");
        $result->execute(array($token, $_COOKIE['id']));

        $_SESSION['login_user'] = $row[0]["username"];
        $_SESSION['user_id'] = $row[0]["id"];
        $_SESSION["user_email"] = $row[0]["email"];
        $_SESSION["user_verified"] = $row[0]["verified"];

        setcookie('id', $_SESSION['user_id'], time()+3600*24*30, $cookie_path);
        setcookie('token', $token, time()+3600*24*30, $cookie_path);
        header("location: ../index.php");
    }
}

?>
<section>
    <article class="card">
        <div style='text-align:left'>
            <form method="post">
                <h2>Connexion</h2><hr>
                <p>Le système de mots de passe ayant changé le 03/05/2018, vos mots de passe datant d'avant cette date ne sont plus valides.</p>
                <a href="update_password.php" class="pwdch">Mettre à jour le mot de passe</a>
                <p>Adresse Email :</p><input type="email" name="email" placeholder="..." required>
                <p>Mot de passe :</p><input type="password" name="password" placeholder="..." required><hr>
                <div style='display:inline-block;padding:0px;margin:7px 0px 0px 0px;'>
                    <p style='width:auto;margin-top:0px;float:left'>Rester connecté ?</p>
                    <input style='float:left' type='checkbox' name='stayConnected'>
                </div>
                <input type="submit" style="margin-top:10px" value="Connexion">
                Vous n'êtes toujours pas inscrit ? <a href="register.php" class="pwdch">S'inscrire</a>
                <p  class="alert"><?php echo $error ?></p>
            </form>
        </div>
    </article>
</section>
    
<?php include("../footer.php"); ?>