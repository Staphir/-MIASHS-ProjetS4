<?php 
$menu["title"] = "Mon compte";
include("main_header.php");
$isConnected = false;

if (!empty($_SESSION)) {
    $isConnected = true;
    $query = "SELECT * FROM user WHERE id = ?";
    $result = $pdo->prepare($query);
    $result->execute(array($_SESSION["user_id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if (!count($row)) {
        echo "<script type='text/javascript'>alert('Une erreur s'est produite !');</script>";
        header("location: index.php");
    }
}
if (!$isConnected) {
    echo "<script type='text/javascript'>alert('Vous n'êtes pas connecté !');</script>";
    header("location: user_handling/login.php");
} else { ?>
<section>
    <article class="card">
        <div>
            <h2>Mon compte</h2><hr>
            <p>Vous trouverez ici les informations liées à votre compte
            <div style="padding-top:0px"><ul class="spacedLi">
            <?php 
                echo "<li><p class='red'>Nom d'utilisateur : </p><p>".$row[0]["username"]."</p></li>";
                echo "<li><p class='red'>Adresse email : </p><p>".$row[0]["email"]."</p></li>";
                echo "<li><p class='red'>Prenom : </p><p>".$row[0]["firstname"]."</p></li>";
                echo "<li><p class='red'>Nom : </p><p>".$row[0]["lastname"]."</p></li>";
                $row[0]["joinedon"] = date('M j Y g:i A', strtotime($row[0]["joinedon"]));
                echo "<li><p class='red'>Date d'inscription : </p><p>".$row[0]["joinedon"]."</p></li>";
            ?>
            </ul></p></div>
            <a class='pwdch' href="user_handling/change_password.php">Changer de mot de passe</a>
        </div>
    </article>
</section>
<?php }
include('footer.php');
?>