<?php 
if (!isset($dir1)) {
    $dir1 = "";
} 
if (!isset($dir2)) {
    $dir2 = "";
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Storystoire - <?php echo $menu["title"]; ?></title>
        <link href=<?php echo $dir2."connect.css" ?> rel="stylesheet" type="text/css" media="all"/>
        <?php 
        ?>
    </head>
    <body style="font-family:'Roboto', sans-serif;">
        <div class="top_header">
            <a href="../index.php" class="s_header_btn" id="home">Accueil</a>
            <?php
            if(isset($_SESSION['login_user'])){
            ?>
            <div class="dropdown" id="user">
                <a class="s_header_btn" href="#"><?php echo $_SESSION['login_user']; ?></a>
                <div class="dropdown-content">
                    <a href="../myaccount.php">Mon compte</a>
                    <a href=<?php echo $dir1."my_stories.php" ?>>Mes histoires</a>
                    <a href=<?php echo $dir1."create_story.php"?>>Créer une histoire</a>
                    <a href="#">Favoris</a>
                    <hr style="margin:10px; margin-top:1px; margin-bottom:1px;">
                    <a href=<?php echo $dir2."logout.php"?>>Se déconnecter</a>
                </div>
            </div>
            <?php } ?>

            <header class="noselect"><h1>Storystoire</h1></header>
        </div>
        <div style="margin-top:100px;">