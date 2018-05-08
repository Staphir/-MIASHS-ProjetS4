<?php 
$menu["title"] = "Mon compte";
include("main_header.php");
$isConnected = false;

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', '');
$purifier = new HTMLPurifier($config);

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $value = $purifier->purify($value);
        $query = "UPDATE user SET $key = '$value' WHERE id = ?;";
        $result = $pdo->prepare($query);
        $result->execute(array($_SESSION['user_id']));
    }
}

if (!empty($_SESSION)) {
    $query = "SELECT * FROM user WHERE id = ?";
    $result = $pdo->prepare($query);
    $result->execute(array($_SESSION["user_id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if (count($row)) {$isConnected = true;}
}


if (!$isConnected) {
    header("location: user_handling/login.php");
} else { ?>

<style>
input#firstname, input#lastname {
    width: auto;
    padding: 0px 3px;
    margin: 0px;
}

div#saveData {
    margin: 0px;
    padding: 0px;
}

div#saveData input {
    width: auto;
    margin: 0px 0px 10px 0px;
    padding: 10px;
}
</style>

<section>
    <article class="card">
        <div>
            <h2>Mon compte</h2><hr>
            <p>Vous trouverez ici les informations liées à votre compte</p>
            <div style="padding-top:0px"><ul class="spacedLi">
                <?php 
                $img = "<a href=><img src=></a>";
                echo "<li><p class='red'>Nom d'utilisateur : </p><p>".$row[0]['username']."</p></li>";
                echo "<li><p class='red'>Adresse email : </p><p>".$row[0]['email']."</p></li>";
                ?>
                <li>
                    <p class='red'>Prenom : </p>
                    <img id='firstnameImg' alt='Edit' src='images/edit.png' width=17>
                    <?php 
                    echo "<p id='firstname'>".$row[0]['firstname']."</p>";
                    echo "<input id='firstname' value='".$row[0]['firstname']."' placeholder='...' type='text' style='display:none;'>";
                    ?>
                </li>
                <li>
                    <p class='red'>Nom : </p>
                    <img id='lastnameImg' alt='Edit' src='images/edit.png' width=17>
                    <?php 
                    echo "<p id='lastname'>".$row[0]['lastname']."</p>";
                    echo "<input id='lastname' value='".$row[0]['lastname']."' placeholder='...' type='text' style='display:none;'>";
                    ?>
                </li>
                <?php
                $row[0]["joinedon"] = date('M j Y g:i A', strtotime($row[0]["joinedon"]));
                echo "<li><p class='red'>Date d'inscription : </p><p>".$row[0]['joinedon']."</p></li>";
                echo "<li><a class='pwdch' href='user_handling/change_password.php'>Changer de mot de passe</a></li>";
                
                ?>
            </ul></div>
            <?php echo "<input type='hidden' id='accountId' value='".$_SESSION['user_id']."'>"; ?>
            <input value="Enregister les modification" id='submitAccountData' type="submit" style='width:auto;'>
        </div>
    </article>
</section>
<?php }
include('footer.php');
?>