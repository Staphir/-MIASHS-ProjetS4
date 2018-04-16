<?php
$menu["title"] = "Contact";
include("main_header.php");
if (!empty($_SESSION)) {
    $email = "value=".$_SESSION["user_email"];
    $username = "value=".$_SESSION["login_user"];
} else {
    $email = "";
    $username = "";
}
?>
<section style="margin-right:100px;">
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p>Si vous avez un problème, une question ou si vous voulez simplement nous dire à quel point notre travail est impressionnant vous êtes au bon endroit ! Vous pouvez nous joindre grâce à ce formulaire !</p>
            <p>L'un de nous vous répondra dans les plus brefs délais ! Dans l'espoir qu'on puisse vous aider, Maxime, Martin et Fannie.</p>
        </div>
    </article>
    <article class="card">
        <div>
            <form method="post" action="contact_send.php">
                <h2>Remplir le formulaire</h2><hr>
                <p>Nom d'utilisateur : </p><input type="text" name="username" placeholder="..." required <?php echo $username; ?>></br>
                <p>Adresse Email : </p><input type="email" name="email" placeholder="..." required <?php echo $email; ?>></br>
                <p>Votre commentaire ici : </p><textarea type="comment" id="contact" name="comment" placeholder="..." required></textarea></br>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </article>
</section>
<?php include("footer.php"); ?>