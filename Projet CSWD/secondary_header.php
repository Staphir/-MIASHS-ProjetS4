<?php if (!isset($dir)) {$dir = "";} ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link href=<?php echo $dir."connect.css" ?> rel="stylesheet" type="text/css" media="all"/>
        <?php 
        ?>
    </head>
    <body style="font-family:'Roboto', sans-serif;">
        <div class="top_header">
            <a href="../index.php" class="s_header_btn">Accueil</a>
            <?php
            if(isset($_SESSION['login_user'])){
            ?>
            <div class="dropdown">
                <a class="s_header_btn" style="margin: 16px 16px 16px 100px" href="#"><?php echo $_SESSION['login_user']; ?></a>
                <div class="dropdown-content">
                    <a href="#">Mon compte</a>
                    <a href="my_stories.php">Mes histoires</a>
                    <a href="story_handling/create_story.php">Créer une histoire</a>
                    <a href="#">Favoris</a>
                    <hr style="margin:10px; margin-top:1px; margin-bottom:1px;">
                    <a href="user_handling/logout.php">Se déconnecter</a>
                </div>
            </div>
            <?php } ?>

            <header><h1>Storystoire</h1></header>
        </div>
        <div style="margin-top:100px;">