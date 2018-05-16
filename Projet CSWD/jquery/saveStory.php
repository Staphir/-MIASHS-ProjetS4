<?php
include('../user_handling/config.php');

$query = "SELECT * FROM story_save WHERE id_user = ? AND id_story = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_POST["id_user"], $_POST["id_story"]));
$row = $result->fetchAll();

if($row) {
    $query = "UPDATE story_save SET path = ?, id_story = ?, id_user = ? ;";
} else {
    $query = "INSERT INTO story_save (path, id_story, id_user) VALUES (?, ?, ?) ;";
}
$result = $pdo->prepare($query);
$result->execute(array($_POST['path'], $_POST["id_story"], $_POST["id_user"]));
?>