<?php
include('../user_handling/config.php');

if ($_POST['value'] == '1') {
    $query = "UPDATE story SET likes = likes+1 WHERE id = ? ;";
} else {
    $query = "UPDATE story SET likes = likes-1 WHERE id = ? ;";
}
$result = $pdo->prepare($query);
$result->execute(array($_POST["id_story"]));

$query = "SELECT * FROM story_like WHERE id_user = ? AND id_story = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_POST["id_user"], $_POST["id_story"]));
$row = $result->fetchAll();

if(count($row)) {
    $query = "UPDATE story_like SET val = ?, id_story = ?, id_user = ? ;";
} else {
    $query = "INSERT INTO story_like (val, id_story, id_user) VALUES (?, ?, ?) ;";
}
$result = $pdo->prepare($query);
$result->execute(array($_POST['value'], $_POST["id_story"], $_POST["id_user"]));
?>