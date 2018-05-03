<?php
$dir1 = "../"; $dir2 = "../";
$error = ""; $menu["title"] = "Changer de mot de passe";
$displayForm = true;
include("../main_header.php");


if (count($_SESSION) == 0) {
    header("location: login.php");
} else {
    if (!empty($_POST)) {
        $fP = $_POST["formerPassword"];
        $nP = $_POST["newPassword"];
        $cnP = $_POST["confirmNewPassword"];

        $query = "SELECT * FROM user WHERE id = ? ;";
        $result=$pdo->prepare($query);
        $result->execute(array($_SESSION["user_id"]));
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);

        if (!password_verify(trim($fP), $row[0]["password"])) {
            $error = "Veuillez saisir à nouveau votre ancien mot de passe !";
        } else {
            if (password_verify(trim($nP), $row[0]["password"])) {
                $error = "Saisissez un mot de passe différent de l'ancien !";
            } elseif ($nP != $cnP) {
                $error = "Les nouveaux mots de passes ne correspondent pas !";
            } elseif (strlen($nP) < 8) {
                $error = "Le nouveau mot de passe doit contenir au moins 8 caractères !";
            } else { 
                $query = "UPDATE user SET password = ? WHERE id = ? ;";
                $result=$pdo->prepare($query);
                $result->execute(array(password_hash(trim($nP), PASSWORD_BCRYPT), $_SESSION["user_id"]));
                header("location: change_password.php?pchd=1");
            }
        }
    } elseif (isset($_GET["pchd"]) and $_GET["pchd"] == 1) {
        $displayForm = false;
        ?>
        <section>
            <article class="card">
                <div>
                    <h2>Changer de mot de passe</h2><hr>
                    <p class="alert">Votre mot de passe a été changé avec succès !</p>
                    <p>Vous pouvez maintenant vous reconnecter avec votre nouveau mot de passe.</p>
                </div>
            </article>
        </section><?php
    }
}

if ($displayForm) { ?>
<section>
    <article class="card">
        <div>
            <form action="" method="post">
                <h2>Changer de mot de passe</h2><hr>
                <p>Pour changer de mot de passe, saisissez l'ancien mot de passe puis entrez et confirmez votre nouveau mot de passe.
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