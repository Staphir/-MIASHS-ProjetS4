<?php
require_once("user_handling/config.php");
require_once("user_handling/session.php");
require_once("connect_database.php");

$requete="SELECT Title FROM story WHERE CreatedBy = '$login_session'";
$reponse=$pdo->prepare($requete);
$reponse->execute();
$array_stories = $reponse->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>
        Storystoire - Mes histoires
    </title>
    <!--    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
    <link rel="shortcut icon" href="images/icon.png">
</head>
<body>
<!--<div class="top_header">-->
<!--    <header><h1>Bienvenue sur Storystoire</h1></header>-->
<!--    <nav class="navbar">-->
<!--        <ul class="menu">-->
<!--            <li><img id="mainicon" src="../images/icon.png"-->
<!--                     width=40 height=40></li>-->
<!--            <form action="search.php">-->
<!--                <li class="menuitem"><input type="search" name="search" placeholder="Rechercher"></li>-->
<!--            </form>-->
<!--            <!-- <li class="menuitem"><a href="#">Contacts</a></li> -->
<!--            --><?php
//            if(!isset($_SESSION['login_user'])){
//                echo "<li class='menuitem'><a href='../user_handling/login.php'>Se connecter</a></li>";
//            } else { ?>
<!--                <li>-->
<!--                    <div class="dropdown">-->
<!--                        <a class="userbtn" href="#">--><?php //echo $login_session; ?><!--</a>-->
<!--                        <div class="dropdown-content">-->
<!--                            <a href="#">Mon compte</a>-->
<!--                            <a href="#">Mes histoires</a>-->
<!--                            <a href="#">Créer une histoire</a>-->
<!--                            <a href="#">Favoris</a>-->
<!--                            <hr style="margin:10px; margin-top:1px; margin-bottom:1px;">-->
<!--                            <a href="../user_handling/logout.php">Se déconnecter</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            --><?php //} ?>
<!--        </ul>-->
<!--    </nav>-->
<!--</div>-->

<div>
    <ul>
        <?php
        for($i=0; $i<count($array_stories); $i++){
            echo "<li><a href='story_handling/story_display.php?story=".$array_stories[$i][0]."'>".$array_stories[$i][0]."</a></li>";
        }
        ?>
    </ul>
</div>

<footer style="font-size:12px">Ce site a été créé par Maxime Dulieu, Fannie Lothaire et Martin Devreese</footer>
</body>
</html>