<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires"; $dir = "../user_handling/";

include("../secondary_header.php");
// require_once("connect_database.php");

// je t'ai corrigé ta requête et intégré le main_header.php


// Attention !! le main_header.php se fini par une ouverture de balise
// <div id="maincontent"> qui décale tout ce qui est dedans de 130px vers le pas pour 
// pas que ça s'affiche en dessous du bandeau rouge. 
// Donc il faut mettre tout dedans.
// Il faudrait rajouter un footer général qui ferme cette balise div.


$requete="SELECT story.Id,Title FROM story INNER JOIN user ON story.User_id = user.id WHERE user.Username = ?";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($login_session));
$array_stories = $reponse->fetchAll();
?>

<div>
    <ul>
        <?php
        for($i=0; $i<count($array_stories); $i++){
            echo "<li><a style='z-index:0;' href='../story_handling/story_display.php?story_id=".$array_stories[$i][0]."&&story_title=".htmlspecialchars($array_stories[$i][1], ENT_QUOTES)."'>".$array_stories[$i][1]."</a></li>";
        }
        ?>
    </ul>
</div>
<?php include("../footer.php"); ?>