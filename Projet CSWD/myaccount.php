<?php 
$menu["title"] = "Mon Compte";
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
<section style="margin-right:100px;">
    <article class="card">
        <div>
            <h2>Mon compte</h2><hr>
            <p>Vous trouverez ici les informations liées à votre compte</p>
            <div class="accountInfo"><ul>
            <?php 
                echo "<li>Nom d'utilisateur : ".$row[0]["username"]."</li>";
                echo "<li>Adresse email : ".$row[0]["email"]."</li>";
                echo "<li>Prenom : ".$row[0]["firstname"]."</li>";
                echo "<li>Nom : ".$row[0]["lastname"]."</li>";
                $row[0]["joinedon"] = date('M j Y g:i A', strtotime($row[0]["joinedon"]));
                echo "<li>Date d'inscription : ".$row[0]["joinedon"]."</li>";
            ?>
            </ul></div>
        </div>
    </article>
    <!-- <article class="card">
        <div>
            <p>Ce site est un projet de CSWD (Conception de Site Web Dynamiques) réalisé dans le cadre de la Licence MIASHS de Bordeaux - en souffrance à cause de l'occupation actuelle de son merveilleux site de la Victoire - conçu par trois étudiants fan de fan-fictions (ou pas) !</p>
            <p>Fannie Lothaire, Maxime Dulieu et Martin Devreese vous accueillent alors sur leur site avec grand plaisir et vous invite à les rejoindre et à faire vivre ce projet !</p>
            <hr><p>Bonne lecture de la part de l'équipe !</p>
        </div>
    </article> -->
</section>
<?php }
include('footer.php');
?>