<?php
$menu["title"] = "Rechercher";
include("main_header.php");

$query = "SELECT Title, story.Likes, Username, Description, PublishedOn FROM story INNER JOIN user ON story.User_id = user.Id WHERE Title like '%".$search."%' ORDER BY `story`.`Likes` DESC";
$result = $pdo->prepare($query);
$result->execute(array($search));
$row = $result->fetchAll(PDO::FETCH_ASSOC);

if (!empty($row) && count($row[0])>0) {
    ?><section style="margin-right:100px;"><?php
    for ($i=0; $i<count($row); $i++) {
        $story = $row[$i];
        $story["short_Description"] = (strlen($story["Description"])>=200)?substr($story["Description"], 0, 200)."...":$story["Description"];
        $story["FormalDate"] = date('M j Y g:i A', strtotime($story["PublishedOn"]));

        ?><article class="card">
            <div>
                <h2><a href="read.php"><?php echo $story["Title"] ?></a></h2><hr>
                <p><?php echo $story["short_Description"] ?></p>
                <p style="margin-top:0px;color:grey;font-size:11px;"><?php echo "Publiée par ".$story["Username"]." le ".$story["FormalDate"]." - Likes : ".$story["Likes"] ?></p>
            </div>
        </article><?php
    }
    ?></section><?php
}

include("footer.php");
?>