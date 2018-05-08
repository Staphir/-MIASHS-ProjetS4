<?php
include('../user_handling/config.php');

$array = array(
    "DELETE FROM choice WHERE id_story = ? ;",
    "DELETE FROM step WHERE id_story = ? ;",
    "DELETE FROM story WHERE id = ? ;",
);
foreach ($array as $query) {
    $result = $pdo->prepare($query);
    $result->execute(array($_POST["id"]));
}
?>