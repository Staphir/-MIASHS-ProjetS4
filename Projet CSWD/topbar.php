<nav class="navbar">            
    <ul class="menu">
        <li>
            <a href=<?php echo $dir1."index.php" ?>><img id="mainicon" alt="Icon Storystoire" src=<?php echo $dir1."images/icon.png"; ?>
            width=40 height=40></a>
        </li>
        <li class="menuitem">
            <form action=<?php echo $dir1."search.php" ?> method="get">
                <input id='searchBox' size=50 type="search" name="search" placeholder="Rechercher un titre..." <?php echo $search_value; ?>>
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
        <li class="menuitem bef">
            <?php 
            if ($menu["title"] == "À propos") {
                ?><p class="noselect">À propos</p><?php
            } else {
                ?><a href=<?php echo $dir1."about.php"; ?>>À propos</a><?php
            }
            ?>
        </li>
        <li class="menuitem bef">
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
            ?><li class="menuitem bef"><?php
            if (in_array($menu["title"], array("Connexion"))) {
                ?><p class="noselect">Se connecter</p><?php
            } else {
                ?><a href=<?php echo $dir1."user_handling/login.php" ?>>Se connecter</a><?php
            } ?></li><?php
        } else { ?>
        <li class='bef'>
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
