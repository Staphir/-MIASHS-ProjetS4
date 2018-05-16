<?php
$menu["title"] = "Accueil";
include("main_header.php");

if (isset($_COOKIE['id']) && empty($_SESSION)) {
    header('location: user_handling/login.php');
}

?>
<!-- END OF TOP HEADER -->
<section id="home">
    <article class="card">
        <div>
        <img src="images/main_pic_redim2.jpg" alt='Accueil'/>
            <h2>Présentation</h2><hr>
            <p>Bonjour et bienvenue sur Storystoire, le site des histoires dont VOUS êtes le héros !</p>
            <p>Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre !</p>
        </div>
    </article>
    <article class="card" id="top10_card">
        <div>
        <h2 class="top10">Top 10 des histoires</h2><hr>
        <?php
        $query = "SELECT story.id, title, story.likes, user.username FROM story, user WHERE story.user_id = user.id AND published = 1 ORDER BY story.likes DESC, title ASC LIMIT 10 ";
        $result = $pdo->prepare($query);
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_ASSOC);

        $count = count($row);
        ?> <ol class='spacedLi'> <?php
        for ($i=0; $i<$count; $i++) {
            echo "<li><a href='read.php?id=".$row[$i]["id"]."'>".$row[$i]["title"]."</a></li>";
        } ?> </ol>
        </div>              
    </article>
    <article class="card">
        <div>
            <h2>Actualités</h2><hr>
            <h3>Remise des projets imminente !</h3>
            <p>En effet, il est l'heure de rendre les projets de CSWD ! Ce site étant désormais presque (presque) entièrement fonctionnel. Vous pouvez commencer à l'utiliser normalement ! C'est à dire créer un compte, créer des histoires, les partager et vivres celles des autres ! Vous risquez de tomber sur quelques erreurs dont nous ne sommes pas forcément au courant. Nous vous invitons donc si c'est le cas à les rapporter sur la page contact une fois que vous serez connecté. Merci d'avance !</p>
        </div>
    </article>
    <!-- <article class="card">
        <div>
            <h2>Commentaires</h2><hr>
            <p>Ceci est un commentaires permettant de générer du contenu</p>
            <p>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.</p>
        </div>
    </article>
    <article class="card">
        <div>
            <h2>A propos</h2><hr>
            <p>Ceci est un commentaires permettant de générer du contenu</p>
            <p>Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.</p>
        </div>
    </article> -->
</section>

<aside class="top10">
    <h2 class="top10">Top 10 des histoires</h2><hr>
    <ol class='spacedLi'> <?php
    for ($i=0; $i<$count; $i++) {
        echo "<li><a href='read.php?id=".$row[$i]["id"]."'>".$row[$i]["title"]."</a></li>";
    } ?> </ol>
</aside>
<?php include("footer.php"); ?>