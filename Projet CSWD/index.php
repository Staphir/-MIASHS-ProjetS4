<?php
$menu["title"] = "Accueil";
include("main_header.php");
?>
        <!-- END OF TOP HEADER -->
            <sectio style="width: 80%;">
                <article class="card">
                    <img src="images/main_pic_redim2.jpg" width=100% height=100%/>
                    <div>
                        <h2>Présentation</h2><hr>
                        <p>Bonjour et bienvenue sur Storystoire, le site des histoires dont VOUS êtes le héros !</p>
                        <p>Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre !</p>
                    </div>
                </article>
                <article class="card">
                    <div>
                        <h2>Exemple de texte</h2><hr>
                        <p>Ceci est un commentaires permettant de générer du contenu</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>
                    </div>
                </article>
                <article class="card">
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
                </article>
            </section>

            <aside class="top10">
                    <h2 class="top10">Top 10 des histoires</h2>
                    <?php
                    $query = "SELECT Title, story.Likes, user.Username FROM story, user WHERE story.User_id = user.Id AND Published = 1 ORDER BY `story`.`Likes` DESC LIMIT 10 ";
                    $result = $pdo->prepare($query);
                    $result->execute();
                    $row = $result->fetchAll(PDO::FETCH_ASSOC);

                    $count = count($row);
                    ?> <ol> <?php
                    for ($i=0; $i<$count; $i++) {
                        echo "<li><a href=''>".$row[$i]["Title"]."</a></li>";
                    } ?> </ol> <?php

                    ?>
            </aside>
<?php include("footer.php"); ?>