<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir2 = "../user_handling/";
include("../secondary_header.php");

$requete="SELECT story.id,title FROM story INNER JOIN user ON story.User_id = user.id WHERE user.username = ?";
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