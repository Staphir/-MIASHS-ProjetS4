<?php
include('../user_handling/config.php');

$query = "UPDATE story SET published = ?, publishedon = NOW() WHERE id = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_POST['published'], $_POST["id"]));
?>