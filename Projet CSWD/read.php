<?php
$menu["title"] = "Lecture";
include("main_header.php");
if (empty($_GET)) {
    header("location: search.php");
} else {
    $query = "SELECT title, story.likes, user.username, description, publishedon  
        FROM story, user WHERE story.user_id = user.id AND published = 1 AND story.id = ?";
    $result = $pdo->prepare($query);
    $result->execute(array($_GET["id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($row) && count($row[0])>0) {
    $story = $row[0];
    $story["FormalDate"] = date('M j Y G:i', strtotime($story["publishedon"]));
    ?>
    <section>
        <article class="card">
            <div>
                <h1 style="text-align:center; font-size:2em">
                    <?php echo $story["title"] ?></h1>
                <p style="margin-top:0px;color:grey;font-size:11px; text-align:center;">
                    <?php echo " - Publiée par <strong>".$story["username"]."</strong> le ".
                    $story["FormalDate"]." - <strong>Likes : ".$story["likes"]."</strong> - " ?></p><hr>
                <p><?php echo $story["description"] ?></p>
                <button type="read">Démarrer la lecture</button>
            </div>
        </article>
    </section>
<?php } ?>