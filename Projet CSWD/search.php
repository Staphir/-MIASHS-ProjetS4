<?php
$menu["title"] = "Rechercher";
include("main_header.php");

$query = "SELECT title, story.likes, username, story.id, description, publishedon FROM story INNER JOIN user ON story.user_id = user.id WHERE title like '%".$search."%' AND published = 1 ORDER BY `story`.`likes` DESC";
$result = $pdo->prepare($query);
$result->execute(array($search));
$row = $result->fetchAll(PDO::FETCH_ASSOC);

if (!empty($row) && count($row[0])>0) {
    ?><section style="margin-right:100px;"><?php
    for ($i=0; $i<count($row); $i++) {
        $story = $row[$i];
        $story["short_Description"] = (strlen($story["description"])>=200)?substr($story["description"], 0, 200)."...":$story["description"];
        $story["FormalDate"] = date('M j Y g:i A', strtotime($story["publishedon"]));

        ?><article class="card">
            <div>
                <h2><a href=<?php echo "read.php?id=".$story["id"]; ?>><?php echo $story["title"] ?></a></h2><hr>
                <p><?php echo $story["short_Description"] ?></p>
                <p style="margin-top:0px;color:grey;font-size:11px;"><?php echo "Publiée par ".$story["username"]." le ".$story["FormalDate"]." - ".$story["likes"]." Likes" ?></p>
            </div>
        </article><?php
    }
    ?></section><?php
} else {
    ?><section style="margin-right:100px;">
        <article class="card">
            <div>
                <h2>Aucun résultats...</h2><hr>
                <p>La recherche n'a retourné aucun résultats !</p>
            </div>
        </article>
    </section><?php
}
include("footer.php");
?>