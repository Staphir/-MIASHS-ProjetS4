<?php include("main_header.php"); ?>
        <!-- END OF TOP HEADER -->
        <div id="maincontent">
            <section>
                <article>
                    <img src="images/main_pic_redim2.jpg" width=100% height=100%/>
                    <h2>Présentation</h2>
                    <p>Bonjour et bienvenue sur Storystoire, l'histoire dont VOUS êtes le héros !</p>
                    <p>Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre ! (Je suis pas bon pour rédiger les descriptions)</p>
                </article>
            </section>
        
            <aside>
                <h2>Top 10 des histoires</h2>
                    <?php
                    $sql = "SELECT Title, story.Likes, user.Username FROM story, user WHERE story.User_id = user.Id ORDER BY `story`.`Likes` DESC LIMIT 10 ";
                    $result = mysqli_query($db,$sql);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    print_r($row);
                    $count = mysqli_num_rows($result);
                    ?> <ul> <?php
                    for ($i=0; $i<$count; $i++) {
                        echo "<li><a href=''>".$row["Title"]."</a></li>";
                    } ?> </ul> <?php

                    ?>
            </aside>
        </div>
    </body>
</html>