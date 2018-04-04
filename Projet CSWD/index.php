<?php
$menu["title"] = "Accueil";
include("main_header.php"); ?>
        <!-- END OF TOP HEADER -->
            <section>
                <article class="card">
                    <img src="images/main_pic_redim2.jpg" width=100% height=100%/>
                    <div class="card_text">
                        <h2>Présentation</h2><hr>
                        <p>Bonjour et bienvenue sur Storystoire, l'histoire dont VOUS êtes le héros !</p>
                        <p>Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre ! (Je suis pas bon pour rédiger les descriptions)</p>
                    </div>
                </article>
            </section>

            <aside class="top10">
                    <h2 class="top10">Top 10 des histoires</h2>
                    <?php
                    $query = "SELECT Title, story.Likes, user.Username FROM story, user WHERE story.User_id = user.Id ORDER BY `story`.`Likes` DESC LIMIT 10 ";
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
        </div>
    </body>
</html>