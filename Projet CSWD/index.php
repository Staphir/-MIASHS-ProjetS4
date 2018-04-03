<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>
            Storystoire - Accueil
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
        <link rel="shortcut icon" href="images/icon.png">
        <?php require_once("user_handling/config.php"); require_once('user_handling/session.php');?>
    </head>
    <body>
        <div class="top_header">
            <header><h1>Bienvenue sur Storystoire</h1></header>
            <nav class="navbar">
                <ul class="menu">
                    <li><img id="mainicon" src="images/icon.png"
                    width=40 height=40></li>
                    <form action="search.php">
                        <li class="menuitem"><input type="search" name="search" placeholder="Rechercher"></li>
                    </form>
                    <!-- <li class="menuitem"><a href="#">Contacts</a></li> -->
                    <?php
                    if(!isset($_SESSION['login_user'])){
                        echo "<li class='menuitem'><a href='user_handling/login.php'>Se connecter</a></li>";
                    } else { ?>
                    <li>
                        <div class="dropdown">
                            <a class="userbtn" href="#"><?php echo $login_session; ?></a>
                            <div class="dropdown-content">
                                <a href="#">Mon compte</a>
                                <a href="#">Mes histoires</a>
                                <a href="#">Créer une histoire</a>
                                <a href="#">Favoris</a>
                                <hr style="margin:10px; margin-top:1px; margin-bottom:1px;">
                                <a href="user_handling/logout.php">Se déconnecter</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>            
            </nav>
        </div>
        <!-- END OF TOP HEADER -->
        <div id="maincontent">
            <section>
                <article>
                    <img src="images/main_pic_redim.jpg" width=100% height=100%/>
                    <h2>Présentation</h2>
                    <p>Bonjour et bienvenue sur Storystoire, l'histoire dont VOUS êtes le héros !</p>
                    <p>Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre ! (Je suis pas bon pour rédiger les descriptions)</p>
                </article>
            </section>
        
            <aside>
                <h2>Top 10 des histoires</h2>
                    <?php
                    // $sql = "SELECT Title, story.Likes, user.Username FROM story, user WHERE story.User_id = user.Id ORDER BY `story`.`Likes` DESC LIMIT 10 ";
                    // $result = mysqli_query($db,$sql);
                    // if (!$result) {
                    //     printf("Error: %s\n", mysqli_error($db));
                    //     exit();
                    // }
                    // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    // print_r($row);
                    // $count = mysqli_num_rows($result);
                    // ?> <ul> <?php
                    // for ($i=0; $i<$count; $i++) {
                    //     echo "<li><a href=''>".$row["Title"]."</a></li>";
                    // } ?> </ul> <?php

                    ?>
            </aside>
        </div>
    </body>
</html>