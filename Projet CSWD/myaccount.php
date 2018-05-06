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
        <div><form method='post'>
            <h2>Mon compte</h2><hr>
            <p>Vous trouverez ici les informations liées à votre compte</p>
            <div style="padding-top:0px"><ul class="spacedLi">
                <?php 
                $img = "<a href=><img src=></a>";
                echo "<li><p class='red'>Nom d'utilisateur : </p><p>".$row[0]['username']."</p></li>";
                echo "<li><p class='red'>Adresse email : </p><p>".$row[0]['email']."</p></li>";

                echo "<li id=firstnameContainer><p class='red'>Prenom : </p><p id='firstname'>".$row[0]['firstname']."</p>
                    <img id='firstnameImg' alt='Edit' src='images/edit.png' width=17 onclick=modifyData('firstname')></li>";
                echo "<li id=lastnameContainer><p class='red'>Nom : </p><p id='lastname'>".$row[0]['lastname']."</p>
                    <img id='lastnameImg' alt='Edit' src='images/edit.png' width=17 onclick=modifyData('lastname')></li>";
                
                $row[0]["joinedon"] = date('M j Y g:i A', strtotime($row[0]["joinedon"]));
                echo "<li><p class='red'>Date d'inscription : </p><p>".$row[0]['joinedon']."</p></li>";
                echo "<li><a class='pwdch' href='user_handling/change_password.php'>Changer de mot de passe</a></li>";
                
                echo "<input id='constantFirstname' type='hidden' value=".$row[0]['firstname'].">";
                echo "<input id='constantLastname' type='hidden' value=".$row[0]['lastname'].">"

                ?>
            </ul></div>
            <div id='saveData'></div>
        </form></div>
    </article>
</section>
<script type="text/javascript" src="accountDataModify.js"></script>
<?php }
include('footer.php');
?>