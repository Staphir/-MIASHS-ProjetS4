<?php
$dir1 = "../"; $dir2 = "../";
$error = ""; $menu["title"] = "Mettre à jour le mot de passe";
$displayForm = true;
include("../main_header.php");

if (!empty($_POST)) {
    $email = $_POST["email"];
    $fP = $_POST["formerPassword"];
    $nP = $_POST["newPassword"];
    $cnP = $_POST["confirmNewPassword"];

    $query = "SELECT * FROM user WHERE email = ? and password = MD5(?) ;";
    $result=$pdo->prepare($query);
    $result->execute(array($email, $fP));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);

    if ($count == 0) {
        $error = "Combinaison adresse mail / mot de passe invalide !";
    } else {
        if ($nP != $cnP) {
            $error = "Les nouveaux mots de passes ne correspondent pas !";
        } elseif (strlen($nP) < 8) {
            $error = "Le nouveau mot de passe doit contenir au moins 8 caractères !";
        } else { 
            $query = "UPDATE user SET password = ? WHERE email = ? ;";
            $result=$pdo->prepare($query);
            $result->execute(array(password_hash(trim($nP), PASSWORD_BCRYPT), $email));
            header("location: update_password.php?pchd=1");
        }
    }
} elseif (isset($_GET["pchd"]) and $_GET["pchd"] == 1) {
    $displayForm = false;
    ?>
    <section>
        <article class="card">
            <div>
                <h2>Mettre à jour le mot de passe</h2><hr>
                <p class="alert">Votre mot de passe a été mis à jour avec succès !</p>
                <p>Vous pouvez maintenant vous reconnecter avec votre nouveau mot de passe.</p>
            </div>
        </article>
    </section><?php
}

if ($displayForm) { ?>
<section>
    <article class="card">
        <div>
            <form action="" method="post">
                <h2>Mettre à jour le mot de passe</h2><hr>
                <p>Pour changer de mot de passe, saisissez votre adresse mail et votre ancien mot de passe puis entrez et confirmez votre nouveau mot de passe. (vous pouvez réutiliser le même)
                <p class="alert">Adresse email :</p><input type="email" name="email" placeholder="..." required>
                <p class="alert">Ancien mot de passe :</p><input type="password" name="formerPassword" placeholder="..." required><hr style="margin:50px; border:0px">
                <p class="alert">Nouveau mot de passe :</p><input type="password" name="newPassword" placeholder="..." required>
                <p class="alert">Confirmer le mot de passe :</p><input type="password" name="confirmNewPassword" placeholder="..." required>
                <input type="submit" style="margin-top:20px" value="Valider">
                <p class="alert"><?php echo $error ?></p>
            </form>
        </div>
    </article>
</section>
<?php
}
include("../footer.php"); ?>