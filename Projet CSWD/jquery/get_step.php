<?php
include('../user_handling/config.php');

if (!empty($_POST)) {
    $query = 'SELECT * FROM step WHERE id_story = ? AND id_choice = ? ;';
    $array = array($_POST['id'], $_POST['parent']);
    $result = $pdo->prepare($query);
    $result->execute($array);
    $row1 = $result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($row1);

    if ($row1) {
        $query = 'SELECT * FROM choice WHERE id_story = ? AND id_step = ? ;';
        $array = array($_POST['id'], $row1[0]['id']);
        $result = $pdo->prepare($query);
        $result->execute($array);
        $row2 = $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $row2 = [];
    }
    $toEncode = array($row1, $row2);
    echo json_encode($toEncode);
} else {header('index.php');}
?>