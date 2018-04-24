<?php
$menu["title"] = "Contact";
include("main_header.php");
?>
<section>
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p class="alert">Votre commentaire a bien été envoyé !</p>
            <p>L'un de nous vous répondra dans les plus brefs délais ! Dans l'espoir qu'on puisse vous aider, Maxime, Martin et Fannie.</p>
            <p>Vous allez être redirigé vers la page d'accueil.</p>
            <script>setTimeout(function () {window.location.href = 'index.php';},7000)</script>
        </div>
    </article>
</section>
<?php include("footer.php"); ?>