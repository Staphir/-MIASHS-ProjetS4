<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
// require_once("../connect_database.php");
if(isset($_POST["story_name"]) && isset($_POST["story_description"])){
    $name = $_POST["story_name"];
    $description = $_POST["story_description"];
    $requete="INSERT INTO story (Title, Description, CreatedOn, Likes, LastModifiedOn, User_id) VALUES (?,?,NOW(),0,NOW(),?)";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($name, $description, $_SESSION["user_id"]));
    header("location: ../my_stories.php");
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>
        Storystoire - Accueil
    </title>
<!--    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
    <link rel="shortcut icon" href="../images/icon.png">
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
    <form action="" method="post">
        Nom de l'histoire :<input type="text" name="story_name" required>
        <br>
        Description :<textarea name="story_description" cols="85" rows="10" required></textarea>
        <input type="submit" name="create" value="Créer">
    </form>
</div>

<footer style="font-size:12px">Ce site a été créé par Maxime Dulieu, Fannie Lothaire et Martin Devreese</footer>
</body>
</html>