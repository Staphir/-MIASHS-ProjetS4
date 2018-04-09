<?php 
if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET["search"])) {
        $search = $_GET["search"];
    } else {$search = "";}
} else {$search = "";}

$search_value = "value=".$search;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>
            Storystoire - <?php echo $menu["title"]; ?>
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
        <link rel="shortcut icon" href="images/icon.png">
        <?php 
        require_once("user_handling/config.php");
        require_once('user_handling/session.php');
        ?>
    </head>
    <body>
        <div class="top_header">
            <header class="noselect"><h1>Bienvenue sur Storystoire</h1></header>
            <nav class="navbar">
                <ul class="menu">
                    <li>
                        <a href="index.php"><img id="mainicon" src="images/icon.png"
                        width=40 height=40></a>
                    </li>
                        <form action="search.php" method="get">
                            <li class="menuitem"><input type="search" name="search" placeholder="Rechercher un titre..." <?php echo $search_value; ?>></li>
                        </form>
                    <li class="menuitem">
                        <?php 
                        if ($menu["title"] == "À propos") {
                            ?><p class="noselect">À propos</p><?php
                        } else {
                            ?><a href="about.php">À propos</a><?php
                        }
                        ?>
                    </li>
                    <li class="menuitem">
                        <?php 
                        if ($menu["title"] == "Contact") {
                            ?><p class="noselect">Contact</p><?php
                        } else {
                            ?><a href="contact.php">Contact</a><?php
                        }
                        ?>
                    </li>

                        <?php
                        if(!isset($_SESSION['login_user'])){
                            echo "<li class='menuitem'><a href='user_handling/login.php'>Se connecter</a></li>";
                        } else { ?>
                    <li>
                        <div class="dropdown">
                            <a class="userbtn" href="#"><?php echo $login_session; ?></a>
                            <div class="dropdown-content">
                                <a href="#">Mon compte</a>
                                <a href="story_handling/my_stories.php">Mes histoires</a>
                                <a href="story_handling/create_story.php">Créer une histoire</a>
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
        <div id="maincontent">