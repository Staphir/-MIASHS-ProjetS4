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
        <div id="maincontent" style="margin-top:130px">
            <section>
                <article>
                    <h2 id="intro">Présentation</h2>
                    <p class="loremipsum">Bonjour et bienvenue sur Storystoire, l'histoire dont VOUS êtes le héros !</p>
                    <p class="loremipsum">Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre ! (Je suis pas bon pour rédiger les descriptions)</p>
                </article>

                <article>
                    <h2 id="classement">En ce moment</h2>
                    <div class="classement">
                        <h3>Top10 des histoires les plus vues</h3>
                        <ol>
                            <!-- FAIRE LA REQUETE PHP MYSQL DES HISTOIRES LES PLUS LIKE ET EN FAIRE UNE LISTE ORDONEE -->
                        </ol>
                    </div>
                    <!-- <div class="classement">
                        <h3>Top10 des classements des joueurs de tennis féminins</h3>
                        <ol>
                            <li>WOZNIACKI Caroline</li>
                            <li>HALEP Simona</li>
                            <li>SVITOLINA Elina</li>
                            <li>MUGURUZA Garbine</li>
                            <li>PLISKOVA Karolina</li>
                            <li>OSTAPENKO Jelena</li>
                            <li>GARCIA Caroline</li>
                            <li id="prefere">WILLIAMS Venus</li>
                            <li>KERBER Angelique</li>
                            <li>MLADENOVIC Kristina</li>
                        </ol>
                    </div> -->
                </article>

                <article>
                    <h2 id="contact">Contacts</h2>
                </article>
            </section>
        
            <aside>
                <h2>Top 10 des histoires</h2>
                    <a href="https://www.lequipe.fr/Tennis/atp-classement.html">Classement joueurs masculins - L'Equipe.fr</a>
                    <br/><a href="https://www.lequipe.fr/Tennis/wta-classement.html">Classement joueurs féminins - L'Equipe.fr</a>
            </aside>
        </div>
        <footer style="font-size:12px">Ce site a été créé par Maxime Dulieu, Fannie Lothaire et Martin Devreese</footer>
    </body>
</html>