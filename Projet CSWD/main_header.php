<?php 
if (!isset($dir1)) {
    $dir1 = "";
} 
if (!isset($dir2)) {
    $dir2 = "";
}

if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET["search"])) {
        $search = $_GET["search"];
    } else {$search = "";}
} else {$search = "";}

$search_value = "value=".$search;
$full_header = in_array($menu["title"], array("Accueil", "À propos", "Contact", "Mon compte"));
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>
            Storystoire - <?php echo $menu["title"]; ?>
        </title>
        <link href=<?php echo $dir1."css/style.css" ?> rel="stylesheet" type="text/css" media="all"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
        <link rel="shortcut icon" href=<?php echo $dir1."images/icon.png" ?>>
        <?php 
        require_once($dir1."user_handling/config.php");
        require_once($dir1."user_handling/session.php");
        ?>
    </head>
    <body>
        <div class="top_header">
            <?php if ($full_header) {
                ?> <header class="noselect"><h1>Bienvenue sur Storystoire</h1></header> <?php
            } ?>
            <nav class="navbar">
                <ul class="menu">
                    <li>
                        <a href=<?php echo $dir1."index.php" ?>><img id="mainicon" src=<?php echo $dir1."images/icon.png"; ?>
                        width=40 height=40></a>
                    </li>
                    <li>
                        <?php if (!$full_header) {
                        ?> <h1 class="storystoire_header noselect">Storystoire</h1> <?php
                        } ?>
                    </li>
                    <li class="menuitem">
                        <form action=<?php echo $dir1."search.php" ?> method="get">
                            <input type="search" name="search" placeholder="Rechercher un titre..." <?php echo $search_value; ?>>
                        </form>
                    </li>
                    <li class="menuitem">
                        <?php 
                        if ($menu["title"] == "Accueil") {
                            ?><p class="noselect">Accueil</p><?php
                        } else {
                            ?><a href=<?php echo $dir1."index.php"; ?>>Accueil</a><?php
                        }
                        ?>
                    </li>
                    <li class="menuitem">
                        <?php 
                        if ($menu["title"] == "À propos") {
                            ?><p class="noselect">À propos</p><?php
                        } else {
                            ?><a href=<?php echo $dir1."about.php"; ?>>À propos</a><?php
                        }
                        ?>
                    </li>
                    <li class="menuitem">
                        <?php 
                        if ($menu["title"] == "Contact") {
                            ?><p class="noselect">Contact</p><?php
                        } else {
                            ?><a href=<?php echo $dir1."contact.php"; ?>>Contact</a><?php
                        }
                        ?>
                    </li>
                    <?php
                    if(!isset($_SESSION['login_user'])){
                        ?><li class="menuitem"><?php
                        if (in_array($menu["title"], array("Connexion"))) {
                            ?><p class="noselect">Se connecter</p><?php
                        } else {
                            ?><a href=<?php echo $dir1."user_handling/login.php" ?>>Se connecter</a><?php
                        } ?></li><?php
                    } else { ?>
                    <li>
                        <div class="dropdown">
                            <a class="userbtn" href=<?php echo $dir1."myaccount.php"; ?>><?php echo $login_session; ?></a>
                            <div class="dropdown-content">
                                <a href=<?php echo $dir1."myaccount.php"; ?>>Mon compte</a>
                                <a href=<?php echo $dir2."story_handling/my_stories.php" ?>>Mes histoires</a>
                                <a href=<?php echo $dir2."story_handling/create_story.php" ?>>Créer une histoire</a>
                                <a href=<?php echo $dir2."#" ?>>Favoris</a>
                                <hr style="margin:10px; margin-top:1px; margin-bottom:1px;">
                                <a href=<?php echo $dir2."user_handling/logout.php" ?>>Se déconnecter</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>            
            </nav>
        </div>
        <div id="maincontent" <?php echo ($full_header)?"style=margin-top:130px":"style=margin-top:90px"; ?> >