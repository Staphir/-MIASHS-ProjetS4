<nav class="navbar">            
    <?php 
    if ($menu["title"] == "Accueil") {
        ?><p class="noselect"><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/home.png"; ?>>Accueil</p><?php
    } else {
        ?><a href=<?php echo $dir1."index.php"; ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/home.png"; ?>>Accueil</a><?php
    }

    if ($menu["title"] == "À propos") {
        ?><p class="noselect"><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/about.png"; ?>>À propos</p><?php
    } else {
        ?><a href=<?php echo $dir1."about.php"; ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/about.png"; ?>>À propos</a><?php
    }

    if ($menu["title"] == "Contact") {
        ?><p class="noselect"><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/contact.png"; ?>>Contact</p><?php
    } else {
        ?><a href=<?php echo $dir1."contact.php"; ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/contact.png"; ?>>Contact</a><?php
    }
    if ($menu["title"] == "Rechercher") {
        ?><p class="noselect"><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/search.png"; ?>>Rechercher</p><?php
    } else {
        ?><a href=<?php echo $dir1."search.php"; ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/search.png"; ?>>Rechercher</a><?php
    }
    if(!isset($_SESSION['login_user'])){
        if (in_array($menu["title"], array("Connexion"))) {
            ?><p class="noselect"><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/profil.png"; ?>>Se connecter</p><?php
        } else {
            ?><a href=<?php echo $dir1."user_handling/login.php" ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/profil.png"; ?>>Se connecter</a><?php
        }
    } else { ?>
        <a href=<?php echo $dir1."myaccount.php"; ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/profil.png"; ?>><?php echo $login_session; ?></a>
        <div class='accountLinks'>
            <a href=<?php echo $dir1."myaccount.php"; ?>>Mon compte</a>
            <a href=<?php echo $dir2."story_handling/my_stories.php" ?>>Mes histoires</a>
            <a href=<?php echo $dir2."story_handling/create_story.php" ?>>Créer une histoire</a>
            <a href=<?php echo $dir2."#" ?>>Favoris</a>
        </div>
        <hr style="margin:5px; border:0px;">
        <a id='logoutSideBar' href=<?php echo $dir2."user_handling/logout.php" ?>><img width=17 style='margin-right:10px;' src=<?php echo $dir1."images/logout.png"; ?>>Se déconnecter</a>
        
    <?php } ?>          
</nav>
