<?php
$menu["title"] = "Rechercher";
include("main_header.php");


$query = "SELECT title, story.likes, username, story.id, description, publishedon FROM story INNER JOIN user ON story.user_id = user.id WHERE title like '%".$search."%' AND published = 1 ORDER BY `story`.`likes` DESC";
$result = $pdo->prepare($query);
$result->execute(array($search));
$row = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="search">
    <div>
        <h2 style='font-size:15px;padding:0px'>Résultats de la recherche pour :</h2>
        <?php echo ($search=='')?"Toutes les histoires":$search; ?>
    </div>
</div>
<aside class='searchAttr'>
</aside>
<section style='margin-left:190px; margin-right:0px;margin-top:-20px;'>
    <?php
    if (!empty($row) && count($row[0])>0) {
    ?>
    <article class="card" style='margin-right:30px'>
        <div style='padding:10px;margin-right:30px'>
        <?php
        for ($i=0; $i<count($row); $i++) {
            $story = $row[$i];
            $story["FormalDate"] = date('M j Y g:i A', strtotime($story["publishedon"])); ?>
            <div class='searchStoryElemt' style='padding:0px;font-style:italic;'>
                <h2 style='margin:0px;font-size:17px;;font-style:normal'><a href="<?php echo "read.php?id=".$story["id"]; ?>"><?php echo $story["title"] ?></a></h2>
                    <?php echo $story["description"] ?>
                <p style="margin:0px;color:rgba(0, 0, 0, 0.33);font-size:11px;;font-style:normal"><?php echo "Publiée par <strong>".$story["username"]."</strong> le ".$story["FormalDate"]." - <strong>".$story["likes"]." Likes</strong>" ?></p>
            <?php
            if (!($i == count($row)-1)) { ?><hr style='color:rgba(230, 230, 230, 0.207)'><?php } ?>
            </div>
        <?php } ?>
        </div>
    </article>
    <?php } else { ?>
    <article class="card" style='padding:10px;margin-right:30px'>
        <div>
            <h2>Aucun résultat...</h2><hr>
            <p>La recherche n'a retourné aucun résultat !</p>
        </div>
    </article>
    <?php } ?>
</section>
<?php
include("footer.php");
?>