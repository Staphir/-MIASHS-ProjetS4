<?php
include('../user_handling/config.php');

$query = "SELECT * FROM story_save WHERE id_user = ? AND id_story = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_POST["id_user"], $_POST["id_story"]));
$row = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($row);
?>