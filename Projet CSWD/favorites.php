<?php 
$menu["title"] = "Mon compte";
include("main_header.php");

if (!empty($_SESSION['user_id'])) {
    $query = "SELECT * FROM story_like, story, user WHERE story_like.id_user = ? AND val = 1 AND id_story = story.id AND story_like.id_user = user.id ;";
    $result = $pdo->prepare($query);
    $result->execute(array($_SESSION["user_id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
<style>
    .linkAccount {
        text-decoration:none;
        margin:0px;
        color:rgba(0, 0, 0, 0.33);
        font-size:11px;
        font-style:normal
    }
    .linkAccount:hover {
        text-decoration:underline;
    }
</style>
<section>
    <article class="card">
        <div>
            <h2>Mes Favoris</h2><hr>
            <p>Ci-dessous vous trouverez la liste des histoires que vous avez aimé :</p>
            <?php
            if (count($row)) {
                for ($i=0; $i<count($row); $i++) {
                    $story = $row[$i];
                    $story["FormalDate"] = date($dateFormat, strtotime($story["publishedon"])); ?>
                    <div class='searchStoryElemt' style='padding:0px;font-style:italic;'>
                        <h2 style='margin:0px;font-size:17px;;font-style:normal'><a href="<?php echo "read.php?id=".$story["id"]; ?>"><?php echo $story["title"] ?></a></h2>
                        <?php echo $story["description"] ?>
                        <p style="margin:0px;color:rgba(0, 0, 0, 0.33);font-size:11px;font-style:normal"><?php echo "Publiée par <strong><a class='linkAccount' href='view_profile.php?u_n=".$story["username"]."'>".$story["username"]."</a></strong> le ".$story["FormalDate"]." - <strong>".$story["likes"]." Likes</strong>" ?></p>
                    <?php
                    if (!($i == count($row)-1)) { ?><hr style='color:rgba(230, 230, 230, 0.207)'><?php }} ?>
                    </div><?php
            } else {
                echo "<p class='red'>Vous n'avez pas encore aimé d'histoire (ou peut-être que si mais nous on le sait pas)</p>";
            }
            ?>

        </div>
    </article>
</section>
<?php include('footer.php'); ?>