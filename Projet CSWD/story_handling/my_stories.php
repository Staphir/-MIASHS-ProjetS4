<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

$requete="SELECT story.id,title FROM story INNER JOIN user ON story.User_id = user.id WHERE user.username = ?";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($login_session));
$array_stories = $reponse->fetchAll();
?>
<section style="margin-right:100px;">
    <article class="card">
        <div>
            <h2>Vos histoires</h2><hr>
            <ul style="list-style-type:circle">
                <?php
                for($i=0; $i<count($array_stories); $i++){
                    echo "<li class='mystories'><a href='../story_handling/story_display.php?story_id=".$array_stories[$i][0]."&&story_title=".htmlspecialchars($array_stories[$i][1], ENT_QUOTES)."'>".$array_stories[$i][1]."</a></li>";
                }
                ?>
            </ul>
        </div>
    </article>
</section>
<?php include("../footer.php"); ?>